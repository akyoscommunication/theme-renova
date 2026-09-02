import fs, { unlink } from 'fs'
import * as path from 'path'
import copy from 'rollup-plugin-copy'
import mkcert from 'vite-plugin-mkcert'
import basicSsl from '@vitejs/plugin-basic-ssl'
import outputManifest, { KeyValueDecorator, OutputManifestParam } from 'rollup-plugin-output-manifest'
import { ConfigEnv, defineConfig, loadEnv, UserConfigExport, createServer } from 'vite'

import sassGlobImports from 'vite-plugin-sass-glob-import';

const publicDir = 'public'
const manifestFile = 'manifest.json'
const assets = {
  base: 'resources',
  scripts: 'resources/assets/js',
  styles: 'resources/assets/css',
  images: 'resources/assets/images',
  fonts: 'resources/assets/fonts'
}

const formatName = (name) => name.replace(`${assets.scripts}/`, '').replace(/.css$/gm, '')
const akyBlade = () => {
  return {
    name: 'aky-blade',
    handleHotUpdate({file,server}) {
      if(file.endsWith('.blade.php')) {
        server.ws.send({
          type: 'full-reload'
        })
      }
    }
  }
}
const hotModuleReplacment = (dev, url) => {
  return {
    name: 'aky-php-hmr-bridge',
    buildStart() {
      url = url.replace("0.0.0.0", "127.0.0.1")
      if(dev) {
        console.log(`🚀 Dev server running at ${url}`)
        fs.mkdirSync(publicDir, { recursive: true })
        fs.writeFile(`${publicDir}/hot`, url, error => {
          if (error) { console.log('🚨 Error writing `hot` :', error) }
        })
      }
    },
    buildEnd() {
      if(dev) {
        console.log("🔥 Closing dev server")
        fs.unlink(`${publicDir}/hot`, error => {
          if (error) { console.log('🚨 Error deleting `hot` :', error) }
        })
      }
    }
  }
}

export default defineConfig(({ mode }) => {
  const devServerConfig = loadEnv(mode, process.cwd(), 'HMR')
  const dev = mode === 'development'
  const config = {
    appType: 'custom',
    publicDir: false,
    base: './',
    resolve: {
      alias: {
        '@': path.resolve(__dirname, assets.base),
        '@js': path.resolve(__dirname, assets.scripts),
        '@css': path.resolve(__dirname, assets.styles),
        '@fonts': path.resolve(__dirname, assets.fonts),
        '@images': path.resolve(__dirname, assets.images)
      }
    },
    css: {
      devSourcemap: true
    },
    plugins: [
      mkcert(),
      sassGlobImports()
    ],
    build: {
      sourcemap: 'inline',
      manifest: false,
      outDir: publicDir,
      assetsDir: '',
      rollupOptions: {
        input: {
          main: path.resolve(__dirname, `${assets.scripts}/main.js`),
          editor: path.resolve(__dirname, `${assets.scripts}/editor.js`)
        },
        output: {
          sourcemap: true
        },
        plugins: [
          outputManifest({
            fileName: manifestFile,
            generate:
              (keyValueDecorator, seed, opt) => chunks =>
                chunks.reduce((manifest, { name, fileName }) => {
                  return name
                    ? {
                      ...manifest,
                      ...keyValueDecorator(formatName(name), fileName, opt)
                    }
                    : manifest
                }, seed)
          }),
          outputManifest({
            fileName: 'entrypoints.json',
            nameWithExt: true,
            generate: (_, seed) => chunks =>
              chunks.reduce((manifest, { name, fileName }) => {
                const formatedName = name && formatName(name)
                const output = {}
                const js =
                  formatedName && manifest[formatedName]?.js?.length ? manifest[formatedName].js : []
                const css =
                  formatedName && manifest[formatedName]?.css?.length
                    ? manifest[formatedName].css
                    : []
                const dependencies =
                  formatedName && manifest[formatedName] ? manifest[formatedName].dependencies : []
                const inject = { js, css, dependencies }

                fileName.match(/.js$/gm) && js.push(fileName)
                fileName.match(/.css$/gm) && css.push(fileName)

                name && (output[formatedName] = inject)

                return {
                  ...manifest,
                  ...output
                }
              }, seed)
          }),
          copy({
            copyOnce: true,
            hook: 'writeBundle',
            targets: [
              {
                src: path.resolve(__dirname, `${assets.base}/images/**/*`),
                dest: `${publicDir}/images`
              },
              {
                src: path.resolve(__dirname, `${assets.base}/svg/**/*`),
                dest: `${publicDir}/svg`
              },
              {
                src: path.resolve(__dirname, `${assets.base}/fonts/**/*`),
                dest: `${publicDir}/fonts`
              }
            ]
          })
        ]
      }
    }
  }

  if (dev) {

    // config.build.rollupOptions.plugins.push(mkcert())
    let host = '0.0.0.0'

    let port = 1111
    const protocol = 'http'
    const https = !!(devServerConfig.HMR_HTTPS_KEY && devServerConfig.HMR_HTTPS_CERT)

    devServerConfig.HMR_HOST && (host = devServerConfig.HMR_HOST)
    devServerConfig.HMR_PORT && (port = parseInt(devServerConfig.HMR_PORT))

    config.plugins.push(hotModuleReplacment(dev, `${protocol}://127.0.0.1:${port}`))
    config.plugins.push(akyBlade())

    unlink(`${publicDir}/${manifestFile}`, error =>  console.log(`🧹 Wipe ${manifestFile} :`, error ? `No ${manifestFile} in the public directory` : '✅'))

    https &&
    (config.server.https = {
      key: devServerConfig.HMR_HTTPS_KEY,
      cert: devServerConfig.HMR_HTTPS_CERT
    })

    config.server = {
      host,
      port,
      https,
      strictPort: true,
      origin: `${protocol}://${host}:${port}`,
      fs: {
        strict: true,
        allow: ['node_modules', assets.base]
      },
      hmr: {
        host: "localhost",
        protocol: "ws"
      },
      watch: {
        include: [
          'resources/views/**/*.blade.php',
        ],
        usePolling: true,
        interval: 1000
      },

      /***
       * For Windows user with files system watching not working
       * https://vitejs.dev/config/server-options.html#server-watch
       */

    }

    // const server = createServer(config)
    // console.log("############ CREATE FILE ############")
    //
    // server.watcher.on("unlink", debounce(() => {
    //   console.log("############ UNLINK FILE ############")
    // }, 100))

  }

  return config
})

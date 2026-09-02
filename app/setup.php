<?php

/**
 * Theme setup.
 */

namespace App;

use Akyos\Core\Classes\Vite;
use App\View\Blade\AppRuntimeDirectives;
use function Roots\bundle;
use function Akyos\Core\Helpers\vite;

function hmr_enabled(): bool
{
    if (env('WP_ENV') === 'production' || env('WP_ENV') === 'staging') {
        return false;
    }
    return file_exists(get_theme_file_path('/public/hot'));
}

function hmr_assets(string $asset): string
{
    $entrypoint = file_get_contents(get_theme_file_path('/public/hot'));
    return $entrypoint ? "{$entrypoint}/{$asset}" : asset($asset);
}


add_action('wp_enqueue_scripts', function () {

    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');

    if (hmr_enabled()) {
        $asset = 'resources/assets/js/main.js';
        $namespace = strtolower(wp_get_theme()->get('Name'));
        echo '<script type="module" src="' . hmr_assets($asset) . '"></script>';
    } else {
        vite()->enqueue('main');
    }
}, 1);
//
//add_action('wp_enqueue_scripts', function () {
//    wp_enqueue_style('akyos-blocks-style', get_template_directory_uri().'/vendor/akyoscommunication/akyos-blocks/dist/css/main.css', [], 1, false);
//    wp_enqueue_script('akyos-blocks-scripts', get_template_directory_uri().'/vendor/akyoscommunication/akyos-blocks/dist/js/main.js', [], 1, false);
//}, 1);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {

    if (hmr_enabled()) {
        $asset = 'resources/assets/js/editor.js';
        $namespace = strtolower(wp_get_theme()->get('Name'));
        echo '<script type="module" src="' . hmr_assets($asset) . '"></script>';
    } else {
        vite()->enqueue('editor');
    }

}, 100);

add_action('init', function() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
    unregister_taxonomy_for_object_type('post_tag', 'page');
});

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from the Soil plugin if activated.
     *
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil', [
        'clean-up',
        'nav-walker',
        'nice-search',
        'relative-urls',
    ]);

    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'main_navigation' => __('Menu principal', 'sage'),
        'legal_navigation' => __('Liens légaux', 'sage'),
        'footer_navigation' => __('Menu footer', 'sage'),
        'mobile_navigation' => __('Menu mobile', 'sage'),
    ]);

    $ensure_nav_menu = static function (string $location, string $menu_name): void {
        if (has_nav_menu($location)) {
            return;
        }

        $existing = wp_get_nav_menu_object($menu_name);
        $menu_id = $existing instanceof \WP_Term
            ? (int) $existing->term_id
            : wp_create_nav_menu($menu_name);

        if (is_wp_error($menu_id) || !$menu_id) {
            return;
        }

        $locations = get_theme_mod('nav_menu_locations', []);
        $locations[$location] = (int) $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    };

    $ensure_nav_menu('main_navigation', 'Menu principal');
    $ensure_nav_menu('legal_navigation', 'Liens légaux');
    $ensure_nav_menu('footer_navigation', 'Menu footer');
    $ensure_nav_menu('mobile_navigation', 'Menu mobile');


    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');

    $home_page = get_option('page_on_front');
    if (!$home_page) {
        $home_page = wp_insert_post([
            'post_title' => 'Accueil',
            'post_type' => 'page',
            'post_status' => 'publish',
        ]);
    }
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home_page);
    update_option('default_comment_status', 'closed');

}, 20);

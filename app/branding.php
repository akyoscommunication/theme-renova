<?php

declare(strict_types=1);

/**
 * Branding Akyos — login WP, admin CSS, pied de page.
 * Utilise get_theme_file_* : enfant prioritaire, sinon parent.
 */

namespace App;

function akyos_brand_asset_path(string $relative): ?string
{
    $path = get_theme_file_path(ltrim($relative, '/'));

    return is_readable($path) ? $path : null;
}

function akyos_brand_asset_uri(string $relative): ?string
{
    $path = akyos_brand_asset_path($relative);
    if ($path === null) {
        return null;
    }

    return get_theme_file_uri(ltrim($relative, '/'));
}

function akyos_enqueue_brand_styles(string $handle): void
{
    $cssPath = akyos_brand_asset_path('assets/css/admin-branding.css');
    if ($cssPath === null) {
        return;
    }

    wp_enqueue_style(
        $handle,
        (string) akyos_brand_asset_uri('assets/css/admin-branding.css'),
        [],
        (string) filemtime($cssPath)
    );
}

add_action('login_enqueue_scripts', static function (): void {
    $logoPath = akyos_brand_asset_path('assets/images/logo-akyos.png');
    if ($logoPath === null) {
        return;
    }

    akyos_enqueue_brand_styles('akyos-theme-admin-branding');

    $logoUrl = esc_url((string) akyos_brand_asset_uri('assets/images/logo-akyos.png'));
    wp_add_inline_style('akyos-theme-admin-branding', <<<CSS
#login h1 a {
\tbackground-image: url('{$logoUrl}');
\ttext-indent: -9999px;
\toverflow: hidden;
\tdisplay: block;
}
CSS);
}, 20);

add_action('admin_enqueue_scripts', static function (): void {
    akyos_enqueue_brand_styles('akyos-theme-admin-branding');
}, 20);

add_filter('login_headerurl', static fn (): string => 'https://akyos.com');
add_filter('login_headertext', static fn (): string => 'Akyos Communication');

add_filter('admin_footer_text', static function (string $text): string {
    return 'Access by <a href="https://akyos.com" target="_blank" rel="noopener noreferrer">Akyos Communication</a>';
});

add_filter('update_footer', static function (string $text): string {
    $theme = wp_get_theme();

    return sprintf(
        'Thème %s · %s',
        $theme->get('Name') ?: 'Akyos',
        $text
    );
}, 11);

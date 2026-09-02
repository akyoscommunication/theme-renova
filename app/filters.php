<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});

function filter_text_wysiwig_acf($value)
{
    $formats = ['**', '$$', '*$', '%%', '__', '--'];
    $replace = "";
    foreach ($formats as $key) {
        $pattern = '/\\' . $key[0] . '\\' . $key[1] . '(.*?)\\' . $key[0] . '\\' . $key[1] . '/';
        preg_match_all($pattern, $value, $words);
        foreach ($words[1] as $word) {
            if ($key === '**') {
                $replace = '<div class="c-title__item"><span>'.$word.'</span></div>';
            }

            $code = $key[0] . $key[1];
            $value = str_replace($code . $word . $code, $replace, $value);
        }
    }
    return $value;
}

add_filter('acf/format_value/type=textarea', function ($value) {
    return filter_text_wysiwig_acf($value);
});
add_filter('acf_the_content', function ($content) {
    return filter_text_wysiwig_acf($content);
});

add_action('acf/init', function () {
    $palette = get_field('color_palettes', 'option');

    if ($palette) {
        add_theme_support('editor-color-palette', array(
            array('name' => 'Couleur principale ', 'slug' => 'primary', 'color' => $palette["primary"]),
            array('name' => 'Couleur texte fond principale', 'slug' => 'primary', 'color' => $palette["text-primary"]),
            array('name' => 'Couleur secondaire ', 'slug' => 'secondary', 'color' => $palette["secondary"]),
            array('name' => 'Couleur texte fond secondaire', 'slug' => 'primary', 'color' => $palette["text-secondary"]),
            array('name' => 'Couleur de fond du site ', 'slug' => 'background_body', 'color' => $palette["background_body"]),
            array('name' => 'Couleur texte fond du site', 'slug' => 'primary', 'color' => $palette["text-background_body"]),
        ));
    }
});

function echo_color_palette_style(): void
{
    $prefix_color = '--aky-color-';

    $palette = get_field('color_palettes', 'option');
    $style = '<style> :root {';
    if (!$palette) {
        return;
    }
    foreach ($palette as $color_name => $color) {

        $rgb = hexToRgb($color);

        $style .= $prefix_color . $color_name . ": " . $color . ";";
        $style .= $prefix_color . $color_name . "--rgb: " . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ";";
    }
    $style .= '}</style>';
    echo $style;
}

function hexToRgb($hex)
{
    // Enlever le "#" si présent
    $hex = ltrim($hex, '#');

    // Décomposer en trois parties : rouge, vert, bleu
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    return [$r, $g, $b];
}

add_action('wp_head', 'App\\echo_color_palette_style');
add_action('admin_head', 'App\\echo_color_palette_style');

add_action( 'init', function() {
    remove_post_type_support( 'post', 'editor' );
}, 99);


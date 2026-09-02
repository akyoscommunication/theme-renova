<?php

add_filter('block_categories_all', function ($categories) {

    $categories[] = array(
        'slug' => 'element',
        'title' => 'Elements seuls'
    );

    $categories[] = array(
        'slug' => 'content',
        'title' => 'Blocs de contenu'
    );

    $categories[] = array(
        'slug' => 'header',
        'title' => 'Entêtes'
    );

    $categories[] = array(
        'slug' => 'slider',
        'title' => 'Sliders'
    );

    $categories[] = array(
        'slug' => 'post',
        'title' => 'Actualités'
    );

    $categories[] = array(
        'slug' => 'special',
        'title' => 'Blocs spéciaux'
    );

    $categories[] = array(
        'slug' => 'form',
        'title' => 'Formulaires'
    );

    return $categories;
});

remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);
remove_filter('render_block', 'gutenberg_render_layout_support_flag', 10, 2);

add_filter('render_block', function ($block_content, $block) {

    if ($block['blockName'] === 'core/image') {

        $xml = simplexml_load_string($block['innerHTML']);
        $src = $xml->{'img'}->attributes()->{'src'};

        return "<a class='lightbox' href='$src'>".$block['innerHTML']."</a>";
    }

    return $block_content;

}, null, 2);

add_filter('render_block', function ($block_content, $block) {

    global $post;

    if ($block['blockName'] === 'core/columns') {

        $html = '';

        $xml = simplexml_load_string($block['innerHTML']);
        $classes = trim($xml->attributes()->{'class'}, 'wp-block-columns');
        $style = 'style="'.$xml->attributes()->{'style'}.'"';

        $html .= '<section '.$style.' class="'.$classes.'">';

        $html .= '<div class="columns container">';

        if (isset($block['innerBlocks'])) {
            foreach ($block['innerBlocks'] as $inner_block) {
                $html .= render_block($inner_block);
            }
        }

        $html .= '</div>';

        $html .= '</section>';

        return $html;
    }

    return $block_content;

}, null, 2);

add_filter('render_block', function ($block_content, $block) {

    if ($block['blockName'] === 'core/column') {

        $xml = simplexml_load_string($block['innerHTML']);
        $classes = trim($xml->attributes()->{'class'}, 'wp-block-column');
        $style = 'style="'.$xml->attributes()->{'style'}.'"';

        $html = '<div '.$style.' class="column '.$classes.'">';
        if (isset($block['innerBlocks'])) {
            foreach ($block['innerBlocks'] as $inner_block) {
                $html .= render_block($inner_block);
            }
        }
        $html .= '</div>';

        return $html;
    }

    return $block_content;

}, null, 2);

add_filter('allowed_block_types', function ($original_blocks) {

    $allBlocks = WP_Block_Type_Registry::get_instance()?->get_all_registered();

    $acfBlocks = array_filter(array_keys($allBlocks), static function ($key) {
        return str_starts_with($key, 'acf/');
    });

    return array_merge($acfBlocks, [
//        "core/columns"
    ]);
});


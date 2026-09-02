<?php

if (!class_exists("Akyos\\Core\\Wrappers\\PostType")) {
    wp_die("Please install akyos-core via composer. <br> <code>composer require akyos/akyos-x-core</code>");
}

use Akyos\Core\Wrappers\PostType;
use Akyos\Core\Wrappers\Taxonomy;
use Extended\ACF\Fields\Image;

/**
 * |--------------------------------------------------------------------------
 * | Post Types
 * |--------------------------------------------------------------------------
 * |
 * | Here you can register all of the post types for your application.
 * | @see https://akyos.gitbook.io/untitled/php/wordpress-sage/wrappers/posttype-taxonomy
 * |
 */


Taxonomy::register('category', 'Catégorie', 'Catégories', 'categorie', ['post'])
    ->fields([
        Image::make('Image de fond', 'image_background')->format('id')
    ])->make();


//PostType::register(
//    'project',
//    'Réalisation',
//    'Réalisations',
//    'realisations',
//    'portfolio',
//    'true',
//    'true',
//)
//    ->supports(['title', 'editor', 'thumbnail'])
//    ->fields([
//
//    ])
//    ->taxonomies([
//        Taxonomy::register(
//            'project_category',
//            'Catégorie',
//            'Catégories',
//            'categories_realisations',
//            ['project'],
//        )
//    ])
//    ->make();



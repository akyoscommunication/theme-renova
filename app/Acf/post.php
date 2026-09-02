<?php

use Extended\ACF\Fields\Gallery;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Link;
use Extended\ACF\Fields\Repeater;
use Extended\ACF\Fields\Tab;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\URL;
use Extended\ACF\Fields\WYSIWYGEditor;
use Extended\ACF\Location;
use Extended\ACF\Fields\Textarea;
use Extended\ACF\Fields\Number;
use Extended\ACF\Fields\Email;
use Extended\ACF\Fields\TrueFalse;
use Extended\ACF\Fields\Select;
use Extended\ACF\ConditionalLogic;

if (function_exists('register_extended_field_group')) {

    register_extended_field_group([
        'title' => 'Contenu de l\'article',
        'fields' => [
            Repeater::make('Répéteur de contenu', 'repeater_content')
                ->fields([
                    Tab::make('Contenu', 'tab_content'),
                    WYSIWYGEditor::make('Contenu', 'content'),
                    Tab::make('Images', 'tab_images'),
                    Gallery::make('Images', 'images')->format('id')->maxFiles(2),
                ])->layout('block')->minRows(1)->button('Ajouter un contenu'),
        ],
        'location' => [
            Location::where('post_type', '===', 'post'),
        ],
    ]);


    $posts_page_id = get_option('page_for_posts');

    register_extended_field_group([
        'title' => 'Champs de la page Actualités',
        'style' => 'seamless',
        'fields' => [
            \Extended\ACF\Fields\WYSIWYGEditor::make('Contenu', 'content'),
        ],
        'location' => [
            Location::where('post', '===', $posts_page_id),
        ],
    ]);


}


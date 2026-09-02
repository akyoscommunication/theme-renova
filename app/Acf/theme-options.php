<?php

use Akyos\Access\Acf\Fields\ButtonAccess;
use Akyos\Access\Acf\Fields\TitleAccess;
use Extended\ACF\Fields\ColorPicker;
use Extended\ACF\Fields\Gallery;
use Extended\ACF\Fields\Group;
use Extended\ACF\Fields\Image;
use Extended\ACF\Fields\Tab;
use Extended\ACF\Fields\Text;
use Extended\ACF\Fields\URL;
use Extended\ACF\Location;
use Extended\ACF\Fields\Textarea;
use Extended\ACF\Fields\Email;
use Extended\ACF\Fields\TrueFalse;
use Extended\ACF\Fields\Link;

const THEME_OPTION = 'theme-option';

/**
 * Option page ACF
 */


if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'icon_url' => 'dashicons-star-filled', // https://developer.wordpress.org/resource/dashicons/
        'menu_slug' => THEME_OPTION,
        'page_title' => 'Réglages globaux',
        'position' => 21,
    ]);
}


if (function_exists('register_extended_field_group')) {
    register_extended_field_group([
        'title' => 'Réglages globaux',
        'fields' => [
            Tab::make('Couleurs'),
            Group::make('Palette de couleurs', 'color_palettes')
                ->fields([
                    ColorPicker::make('Couleur principale', 'primary')
                        ->column(50),
                    ColorPicker::make('Texte fond couleur principale', 'text-primary')
                        ->column(50),
                    ColorPicker::make('Couleur secondaire', 'secondary')
                        ->column(50),
                    ColorPicker::make('Texte fond couleur secondaire', 'text-secondary')
                        ->column(50),
                    ColorPicker::make('Couleur de fond du site', 'background_body')
                        ->column(50),
                    ColorPicker::make('Texte fond couleur de fond du site', 'text-background_body')
                        ->column(50),
                ]),
            Tab::make('Entête'),
            Image::make("Logo Entête", 'logo')->format('id'),
            Link::make("Bouton de contact", 'cta'),

            Tab::make('Pied de page secondaire'),
            Textarea::make("Texte", "footer_secondary_text")->newLines('br'),
            ButtonAccess::make('Bouton', 'footer_secondary_button'),

            Tab::make('Pied de page'),
            Image::make("Logo Pied de page", 'footer_logo')->format('id')
                ->column(20),
            Textarea::make("Texte", "footer_text")->newLines('br')
                ->column(80),
            Text::make('Titre 1', 'footer_title_1')->column(20),
            Text::make('Titre 2', 'footer_title_2')->column(20),
            Text::make('Titre 3', 'footer_title_3')->column(20),
            Text::make('Copyright', 'footer_copyright'),

            Tab::make('Général'),
            Url::make("X (Twitter)", 'twitter')
                ->column(20),
            Url::make("Linkedin", 'linkedin')
                ->column(20),
            Url::make("Instagram", 'instagram')
                ->column(20),
            Url::make("Facebook", 'facebook')
                ->column(20),
            Url::make("Youtube", 'youtube')
                ->column(20),

            Tab::make('Coordonnées'),
            Text::make("Téléphone", "phone")
                ->column(50),
            Email::make("Email", "email")
                ->column(50),
            Textarea::make("Adresse", "address")->newLines('br')
                ->column(70),
            Textarea::make("Horaires", "hours")->newLines('br')
                ->column(30),

            Tab::make('Blog'),
            TrueFalse::make('Template article enrichi', 'single_post_enhanced')
                ->default(false)
                ->helperText('Sommaire auto (H2), schema Article JSON-LD, mise en page avec sidebar.'),

        ],
        'location' => [
            Location::where('options_page', '===', THEME_OPTION),
        ],
    ]);
}


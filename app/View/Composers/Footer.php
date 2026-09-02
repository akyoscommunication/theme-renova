<?php

/*
 * Controller des menus
 */

namespace app\View\Composers;

use Roots\Acorn\View\Composer;
use function Akyos\Core\Helpers\options;

class Footer extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.footer',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'footer_logo' => options('footer_logo'),
            'address' => options('address'),
            'phone' => options('phone'),
            'email' => options('email'),
            'footer_horaire' => options('hours'),
            'footer_secondary_button' => options('footer_secondary_button'),
            'footer_secondary_description' => options('footer_secondary_description'),
            'footer_secondary_gallery' => options('footer_secondary_gallery'),
            'footer_secondary_text' => options('footer_secondary_text'),
            'footer_text' => options('footer_text'),
            'footer_title_1' => options('footer_title_1'),
            'footer_title_2' => options('footer_title_2'),
            'footer_title_3' => options('footer_title_3'),
            'footer_copyright' => options('footer_copyright'),
        ];
    }

}

<?php

/*
 * Controller des menus
 */

namespace app\View\Composers;

use Roots\Acorn\View\Composer;
use function Akyos\Core\Helpers\options;

class Header extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.header',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'header_button' => options('header_button'),
            'onlyBurger' => get_field('only_burger', 'option'),
            'search' => get_field('header_search', 'option'),
            'social' => get_field('header_social', 'option'),
            'hover' => get_field('hover', 'option'),
            'transparent' => (get_field('header_transparent', 'option') == 1) ? 'transparent' : '',
            'burgerBreakpoint' => get_field('burger_breakpoint', 'option'),
        ];
    }

}

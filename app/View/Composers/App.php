<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use function Akyos\Core\Helpers\options;


class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {

        return [
            'siteName' => $this->siteName(),
            'options' => options(),
            'logo' => options()['logo'] ?? '',
            'isHome' => $this->is_home(),
        ];
    }

    /**
     * Returns the site name.
     *
     * @return string
     */
    public function siteName()
    {
        return get_bloginfo('name', 'display');
    }

    /**
     * @param $url
     * @return string
     */

    public static function get_title_from_url($url): string
    {
        return get_the_title(url_to_postid($url));
    }

    public static function is_home()
    {
        return is_front_page();
    }

    public static function getPagination(\WP_Query $query)
    {

        return paginate_links(
            [
                'base' => str_replace(99999999, '%#%', esc_url(get_pagenum_link(99999999))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages,
                'prev_text' => '<img src="/app/themes/akyos-sage/resources/assets/icons/arrow-next.svg"/>',
                'next_text' => '<img src="/app/themes/akyos-sage/resources/assets/icons/arrow-next.svg"/>'
            ]);
    }

    public static function otherPostsThan($id)
    {
        $args = [
            'post_type' => 'post',
            'posts_per_page' => -1,
            'post__not_in' => [$id],
            'orderby' => 'rand'
        ];
        return (new \WP_Query($args))->posts;
    }

}

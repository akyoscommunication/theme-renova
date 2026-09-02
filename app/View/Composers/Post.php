<?php

namespace App\View\Composers;

use Akyos\Core\Wrappers\QueryBuilder;
use Roots\Acorn\View\Composer;
use Closure;


class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks.last-news-access',
        'partials.content-single',
        'archive',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with(): array
    {
        return [
            'getPosts' => $this->posts(...),
            'getPostsTerm' => $this->getPostsTerm(...),
        ];
    }

    public function posts(int $limit = -1)
    {
        return QueryBuilder::make('post')->limit($limit)->orderBy('date', 'DESC')->get();
    }

    public function getPostsTerm($term, $limit = -1, $taxonomy = 'category', $toExclude = []): array
    {
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $limit,
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => [$term],
                ],
            ],
            'post__not_in' => $toExclude,
        ];

        return (new \WP_Query($args))->posts;
    }
}

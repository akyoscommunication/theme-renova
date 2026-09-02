<?php


namespace App\Controllers;

use Akyos\Core\Wrappers\QueryBuilder;
use function Akyos\Core\Helpers\options;

class PostController
{
    public function get()
    {
        $request = request();
        $page = $request->get('page');
        $per_page = $request->get('per_page');
        $cat = $request->get('categories');

        $query = QueryBuilder::make("post");

        if ($page && $per_page) {
            $query
                ->limit($per_page)
                ->offset(($page - 1) * $per_page);
        }

        if ($cat !== null) {
            $query->category($cat);
        }

        $posts = $query
            ->orderBy('date', 'DESC')
            ->get('query')
            ->posts;

        $posts = array_map(function ($post) {
            $cat = get_the_category($post->ID)[0];
            // Retournez les données dont vous avez besoin pour l'affichage d'un post
            return [
                'id' => $post->ID,
                'post_title' => $post->post_title,
                'link' => get_the_permalink($post),
                'thumbnail' => wp_get_attachment_url(get_post_thumbnail_id($post->ID)),
                'date' => get_the_date('d M Y', $post->ID),
                'excerpt' => get_the_excerpt($post->ID),
                'cat_name' => $cat->name,
            ];
        }, $posts);

        $response = [
            'posts' => $posts,
            'max_pages' => $query->get('query')->max_num_pages,
        ];

        return rest_ensure_response($response);
    }
}

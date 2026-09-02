@extends('layouts.app')

@section('content')

	@php
		$obj = get_queried_object();

      if ($obj instanceof WP_Term) {
        $image = get_field('image_background', 'category_'.$obj->term_id);
        $title = $obj->name;
        $description = $obj->description;
      } else {
        $image = get_post_thumbnail_id($obj->ID);
        $title = $obj->post_title;
        $description = get_field('content', $obj->ID);
      }

      $category = get_query_var('cat') ?: '';

      $args = [
        'post_type' => 'post',
        'posts_per_page' => 8,
        'paged' => get_query_var('paged', 1),
        'cat' => $category,
      ];

      $query = new WP_Query($args);

	@endphp

	@component('blocks.hero-access', [
        'styles' => '',
        'classes' => '',
        'title' => ['tag' => 'h1', 'value' => '<div class="c-title__item"><span>'.$title."</span></div>", 'position' => 'center'],
        'image_background' => $image,
        'button' => [],
        'description' => $description
      ])
	@endcomponent

	<article class="s-archive">
		<div class="container container--archive">

			<div class="c-filter">
				<div class="c-filter-buttons">
					<a href="{{ get_post_type_archive_link('post') }}" class="btn btn--filter c-filter-button {{ empty(get_query_var('cat')) ? 'btn--active' : '' }}">
						<span>Voir tout <span>{{ count($getPosts()) }}</span></span>
					</a>

					@foreach(get_categories() as $cat)
						<a href="{{ get_term_link($cat) }}"
							class="btn btn--filter c-filter-button {{ get_query_var('cat') === $cat->term_id ? 'btn--active' : '' }}">
							<span>{{ $cat->name }} <span>{{ count($getPostsTerm($cat->slug)) }}</span></span>
						</a>
					@endforeach
				</div>
			</div>

			@if($query->posts)
				<div class="c-articles">
					@foreach($query->posts as $post)
						<x-post :post="$post" animation-stagger/>
					@endforeach
				</div>

				@if($query->max_num_pages > 1)
					<div class="c-pagination">
						{{ the_posts_pagination() }}
					</div>
				@endif
			@else
				<p>Aucun article trouvé.</p>
			@endif
		</div>
	</article>
	@php
		wp_reset_postdata();
	@endphp
@endsection

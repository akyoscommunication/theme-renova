@php
  $terms = get_the_terms($post->ID, 'category');
  $term = array_shift($terms);

  $date = date('d/m/Y', strtotime($post->post_date));
@endphp

<article {{ $attributes->merge(['class' => 'c-post']) }} >
  <a class="c-post__permalink" href="{{ get_permalink($post->ID) }}">
  </a>
  <div class="c-post-image">
    <x-image :lg="get_post_thumbnail_id($post->ID)"/>
    <div class="c-post-image-btn">
      <a href="{{ get_term_link($term->term_id) }}" class="c-post-image-btn__category btn btn--category">
        {!! $term->name !!}
      </a>
    </div>
  </div>
  <div class="c-post-content">
    <div class="c-post-content-header">
      <x-title tag="h3" position="left">{!! $post->post_title !!}</x-title>
    </div>
    <div class="c-post-content-body">
      <div class="c-post-content-body__excerpt">
        {!! $post->post_excerpt !!}
      </div>
    </div>
  </div>
</article>

@php
  use Akyos\Access\Support\SinglePostHelper;

  $terms = get_the_terms(get_the_ID(), 'category');
  $term = array_shift($terms);
  $singleEnhanced = SinglePostHelper::isEnabled();
@endphp

<article @if($singleEnhanced) class="single--enhanced" @endif>
  @component('blocks.hero-access', [
     'title' => [
       'tag' => 'h1',
       'value' => get_the_title()
      ],
      'button' => [],
       'description' => '',
       'image_background' => get_post_thumbnail_id(get_the_ID()),
       'classes' => '',
       'styles' => ''
   ])
  @endcomponent

  <section class="single-content">
    @include('akyos-access::partials.single-article-content')

    @if($term && $getPostsTerm($term->slug, 2, 'category', [get_the_ID()]))
      <div class="single-content__other-posts">
        <div class="container">
          <x-title tag="h2" position="left">Nos derniers articles</x-title>
          <div class="other-posts__grid">
            @foreach($getPostsTerm($term->slug, 2, 'category', [get_the_ID()]) as $post)
              <x-post :post="$post" animation-stagger/>
            @endforeach
          </div>
          <x-button href="/actualites"
                    appearance="secondary"
                    :icon="$options['footer_secondary_button']['icon'] ?? null"
          >
            Voir toutes les actualités
          </x-button>
        </div>
      </div>
    @endif
  </section>
</article>

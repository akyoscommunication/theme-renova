<section class="s-last-news {{$classes}}" style="{{ $styles }}">
  <div class="container">

    <x-title_text name="s-last-news" :title="$title" :description="$description"/>
    <div class="s-last-news-posts">
      @foreach($getPosts(2) as $key => $post)
        @if($key === 0)
          <x-post :post="$post"/>
        @else
          <x-post animation-stagger :post="$post"/>
        @endif
      @endforeach
    </div>

    @if($button && $button['link'])
      <x-button
        class="s-last-news-btn"
        href="{{ $button['link']['url'] }}"
        :target="$button['link']['target']"
        :appearance="$button['color']"
        :icon="$button['icon']"
      >
        {!! $button['link']['title'] !!}
      </x-button>
    @endif
  </div>
</section>

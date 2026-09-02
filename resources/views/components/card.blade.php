<article class="c-card" animation-stagger>
  @if($url)
    <a href="{{ $url['url'] }}">
      @endif

      <x-media :media="$image"/>

      <div class="c-card-body">
        @if($title)
          <x-title :tag="$title['tag']">{!! $title['value'] !!}</x-title>
        @endif
        @if(isset($content))
          <div class="c-card-body__text">
            {!! $content !!}
          </div>
        @endif
      </div>

      @if($url)
    </a>
  @endif
</article>

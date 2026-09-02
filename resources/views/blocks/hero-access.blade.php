<section class="s-hero {{ $classes }}" style="{{ $styles }}">
  <div class="container">
    <div class="s-hero-header">

      @if(isset($title))
        <div class="title">
          @if(is_single())
            <div class="date">
              {{ get_the_date('d/m/Y') }}
            </div>
          @endif
        <x-title :tag="$title['tag']"
                 animation-overflow>
          {!! $title['value'] !!}
        </x-title>
        </div>
      @endif

      <div class="s-hero-header-content">
        @if(isset($description))
          <div class="s-hero-header-content__text">
            {!! $description !!}
          </div>
        @endif

        @if($button && $button['link'])
          <x-button href="{{ $button['link']['url'] }}"
                    target="{{ $button['link']['target'] }}"
                    appearance="{!! $button['color'] !!}"
                    icon="{!! $button['icon'] !!}">
            {!! $button['link']['title'] !!}
          </x-button>
        @endif
      </div>
    </div>
    <x-media :media="$image_background" cover animation-parallax animation-wipe/>
  </div>
</section>

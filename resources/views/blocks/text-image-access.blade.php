<section class="s-text-image" style="{{ $styles }}" animation-background="{{ $classes }}">
  <div class="container {{ $position }}">
    <x-title_text name="s-text-image" :title="$title" :description="$content"/>

    <div class="s-text-image-wrapper">
      @if($button && $button['link'])
        <x-button
          href="{{ $button['link']['url'] }}"
          target="{{ $button['link']['target'] }}"
          appearance="{{ $button['color'] }}"
          icon="{{ $button['icon'] }}"
        >
          {!! $button['link']['title'] !!}
        </x-button>
      @endif
      <x-slider
        name="text-image-{{ $block['id'] }}"
        :per="1"
        :perMd="1"
        :perSm="1"
        :perXs="1"
        :modules="['navigation']"
        animation-wipe
      >
        @foreach($images as $image)
          <div class="swiper-slide">
            <x-media :media="$image"/>
          </div>
        @endforeach
      </x-slider>
    </div>
  </div>
</section>

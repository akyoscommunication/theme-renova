<section class="s-text-image-inline" style="{{ $styles }}" animation-background="{{ $classes }}">

  <div class="container">
    <div class="s-text-image-inline-wrapper {{ $position }}">
      <div class="s-text-image-inline-wrapper--image">
        @if($images)
          @foreach($images as $image)
            <x-media :media="$image" animation-wipe/>
          @endforeach
        @endif
      </div>
      <div class="s-text-image-inline-wrapper--text">
        <x-title :tag="$title['tag']" animation-mask>{!! $title['value'] !!}</x-title>

        {!! $content !!}

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
      </div>
    </div>
  </div>
</section>

<section class="s-numbers" style="{{ $styles }}" animation-background="{{ $classes }}">
  <div class="container">

    <div class="s-numbers-header">
      <div>
        <x-title_text name="s-numbers" :title="$title" :description="$description"/>
      </div>
      @if($button && $button['link'])
        <x-button
          href="{{ $button['link']['url'] }}"
          target="{{ $button['link']['target'] }}"
          appearance="{!! $button['color'] !!}"
          icon="{{ $button['icon'] }}">
          {{ $button['link']['title'] }}
        </x-button>
      @endif
    </div>

    <div class="s-numbers-list">
      @foreach($numbers as $number)
        <div class="c-number">
          <div class="c-number-wrapper">
            <x-media :media="$number['image']"/>
            @if($number['number'])
              <div class="c-number__title" animation-number="{{ $number['number'] }}">{{ $number['number'] }}</div>
            @endif
          </div>
          @if($number['description'])
            <div class="c-number__text">{!! $number['description'] !!}</div>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>

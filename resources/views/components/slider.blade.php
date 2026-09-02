<div
  per-view-sm="{{ $per_sm }}"
  per-view-md="{{ $per_md }}"
  per-view-xs="{{ $per_xs }}"
  per-view="{{ $per }}"
  data-slider="{{ $name }}"
  modules="{{ json_encode($modules, JSON_THROW_ON_ERROR) }}"
  extra="{{ json_encode($extra, JSON_THROW_ON_ERROR) }}"
  @if($peekMobile) data-peek-mobile="true" @endif
  {{ $attributes->merge(['class' => 'swiper '.$name]) }} slider>
  <div class="{{ $name }}-wrapper swiper-wrapper">
    {!! $slot !!}
  </div>

  @if(in_array('navigation', $modules, true))
    <div class="swiper-buttons">
      <div class="swiper-button-prev">
        @icon('arrow-slider-prev')
      </div>
      <div class="swiper-button-next">
        @icon('arrow-slider-next')
      </div>
    </div>
  @endif

  @if(in_array('pagination', $modules, true))
    <div class="swiper-pagination"></div>
  @endif

</div>

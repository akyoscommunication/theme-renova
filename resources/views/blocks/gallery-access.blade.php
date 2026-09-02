<section class="s-gallery" style="{{ $styles }}">
  <div class="container">
    <x-slider
      name="text-image-{{ $block['id'] }}"
      :per="1"
      :perMd="1"
      :perSm="1"
      :perXs="1"
      :modules="['navigation']"
      animation-wipe
    >
      @foreach($gallery as $item)
        <div class="swiper-slide">
          @include('akyos-access::partials.gallery-media', ['media' => $item])
        </div>
      @endforeach
    </x-slider>

    <x-title_text name="s-gallery" :title="$title" :description="$description"/>
  </div>
</section>

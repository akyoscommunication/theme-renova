<section class="s-services" style="{{ $styles }}">

  <div class="container">
    <x-title_text name="s-services" :title="$title" :description="$description"/>

    <div class="s-services-list">
      @if(count($services) <= 2)
        <div class="s-services-list-wrapper s-services-list-wrapper--peek">
          @foreach($services as $service)
            <x-card
              :title="$service['title']"
              :content="$service['description']"
              :url="$service['link']"
              :image="$service['image']"
            />
          @endforeach
        </div>
      @else
        <x-slider
          name="services"
          :per="1.8"
          :perMd="2"
          :perSm="1"
          :perXs="1"
          :modules="['navigation']"
          :extra="['spaceBetween' => 20]"
          :peekMobile="true"
        >
          @foreach($services as $service)
            <div class="swiper-slide">
              <x-card
                :title="$service['title']"
                :content="$service['description']"
                :url="$service['link']"
                :image="$service['image']"
              />
            </div>
          @endforeach
        </x-slider>
      @endif
    </div>

    @if(\Akyos\Access\Acf\Fields\ButtonAccess::hasLink($button))
      <x-button
        class="{{ count($services) > 4 ? 'btn--absolute': null }}"
        href="{{ $button['link']['url'] }}"
        target="{{ $button['link']['target'] }}"
        appearance="{{ $button['color'] }}"
      >
        {!! $button['link']['title'] !!}
      </x-button>
    @endif
  </div>
</section>


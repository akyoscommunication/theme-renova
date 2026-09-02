<section class="s-banner" style="{{ $styles }}">
  <div class="container">

    <div class="s-banner-title text-center">
      <x-title_text name="s-banner" :title="$title" :description="$description"/>
    </div>

    <div class="s-banner-list">
      <div class="s-banner-list-wrapper">
        @foreach($elements as $element)
          @if($element['link'])
            <a href="{{ $element['link']['url'] }}" target="_blank">
              @endif
              <x-media :media="$element['image']" animation-stagger/>
              @if($element['link'])
            </a>
          @endif
        @endforeach
      </div>
    </div>
  </div>
</section>

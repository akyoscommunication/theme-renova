<footer>
  <div class="sub-footer">
    <div class="container">
      <div class="sub-footer-inner">
        @if($footer_secondary_text)
          <x-title tag="h2" position="left">{!! $footer_secondary_text !!}</x-title>
        @endif
        @if($footer_secondary_button && $footer_secondary_button['link'])
          <x-button
            href="{{ $footer_secondary_button['link']['url'] }}"
            target="{{ $footer_secondary_button['link']['target'] }}"
            appearance="{{ $footer_secondary_button['color'] ?? 'primary' }}"
            :icon="$footer_secondary_button['icon'] ?? null"
          >
            {!! $footer_secondary_button['link']['title'] !!}
          </x-button>
        @endif
      </div>
    </div>
  </div>

  <div class="footer">
    <div class="container">
      <div class="footer-columns">
        <div class="footer-columns-item">
          @if($footer_logo)
            <x-image variant="logo" :lg="$footer_logo"/>
          @endif
          <div class="footer-columns-item__text">
            @if($footer_text)
              {!! $footer_text !!}
            @endif
          </div>
        </div>
        <div class="footer-columns-item">
          <x-title tag="h4" position="left">{{ $footer_title_1 }}</x-title>
          @menu('footer_navigation')
        </div>
        <div class="footer-columns-item">
          <x-title tag="h4" position="left">{{ $footer_title_2 }}</x-title>
          <p>{!! $address !!}</p>
          <a href="tel:+33{{ $phone }}">{!! $phone !!}</a>
          <a href="mailto:{{ $email }}">{!! $email !!}</a>
          <x-socials/>
        </div>
        <div class="footer-columns-item">
          <x-title tag="h4" position="left">{{ $footer_title_3 }}</x-title>
          <div class="footer-columns-item__text">
            {!! $footer_horaire !!}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="copy-footer">
    <div class="container">
      <p>{!! $footer_copyright !!}</p>
      @menu('legal_navigation')
      <a href="https://akyos.com" target="_blank">Création Akyos</a>
    </div>
  </div>
</footer>


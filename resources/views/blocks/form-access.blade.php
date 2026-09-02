@php $shortcode = "[forminator_form id=".$form."]" @endphp

<section class="s-form {{ $classes }}" style="{{ $styles }}">
  <div class="container {{ $content_position }}">
    <div class="s-form-wrapper">
      <x-title tag="h1" animation-overflow>
        <div class="c-title__item">
          <span>{!! $description_short !!}</span>
        </div>
      </x-title>
      <div class="s-form-infos">
        {!! $options['address'] !!}
        <a href="tel:+33{{ $options['phone'] }}">@icon('phone') {!! $options['phone'] !!}</a>
        <a href="mailto:{{ $options['email'] }}">@icon('mail') {!! $options['email'] !!}</a>
        <x-socials/>
      </div>

    </div>
    <div class="s-form-wrapper" animation-stagger-single="1">
      {!! $shortcode !!}
    </div>
  </div>
</section>

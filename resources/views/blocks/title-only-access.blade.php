<section class="s-title {{ $classes }}" style="{{ $styles }}">
  <div class="container">
    <x-title :tag="$title['tag']"
             animation-mask
    >
      {!! $title['value'] !!}
    </x-title>
  </div>
</section>

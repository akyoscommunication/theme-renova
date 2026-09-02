@if(isset($title))
  <x-title :tag="$title['tag']"
           animation-mask
  >
    {!! $title['value'] !!}
  </x-title>
@endif

@if(isset($description))
  <div class="{{ $name }}__text">
    {!! $description !!}
  </div>
@endif

<a {{ $attributes->merge(['class' => 'btn'.($appearance ? " btn--$appearance" : null)]) }}>
  @if(isset($icon) && $icon)
    <x-image :lg="$icon"/>
  @endif
  <div class="btn-title">
    <div class="btn-title__item">{!! $slot !!}</div>
    <div class="btn-title__item">{!! $slot !!}</div>
  </div>
</a>

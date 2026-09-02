@props([
  'media' => null,
  'cover' => false,
  'variant' => 'image',
  'sm' => null,
  'md' => null,
  'rounded' => false,
])

@include('akyos-access::components.media', get_defined_vars())

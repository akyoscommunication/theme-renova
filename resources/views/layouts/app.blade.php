@if(View::exists('akyos-blocks::sections.header'))
  @include('akyos-blocks::sections.header')
@else
  @include('sections.header')
@endif

<main id="main" class="main">
  @yield('content')
</main>


@if(View::exists('akyos-blocks::sections.footer'))
  @include('akyos-blocks::sections.footer')
@else
  @include('sections.footer')
@endif

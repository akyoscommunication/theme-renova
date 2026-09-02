<header class="header-wrap">

  <div class="container header">
    <div class="header-brand">
      <a href="{!! home_url() !!}">
        <x-image variant="logo" :lg="$options['logo']"/>
      </a>
    </div>

    <div class="header-nav">

      <nav class="header-nav__nav" animation-stagger-single="0.7">
        @menu('main_navigation')
      </nav>

      <div class="header-nav__mobile">
        <div id="burger">
          <span></span>
        </div>
        <div class="mobile-menu">
          @menu('mobile_navigation')
          <x-socials/>
        </div>
      </div>
    </div>
  </div>
</header>

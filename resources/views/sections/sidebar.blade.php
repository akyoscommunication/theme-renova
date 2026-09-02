<section class="s-sidebar">
    <ul class="s-sidebar-socials" animation-stagger-single="1.1">
      @if($options['linkedin'])
        <li class="s-sidebar-socials__item">
          <a class="btn btn--social" href="{{ $options['linkedin'] }}" target="_blank">
            @icon('linkedin')
          </a>
        </li>
      @endif
      @if($options['instagram'])
        <li class="s-sidebar-socials__item">
          <a class="btn btn--social" href="{{ $options['instagram'] }}" target="_blank">
            @icon('instagram')
          </a>
        </li>
      @endif
      @if($options['facebook'])
        <li class="s-sidebar-socials__item">
          <a class="btn btn--social" href="{{ $options['facebook'] }}" target="_blank">
            @icon('facebook')
          </a>
        </li>
      @endif
      @if($options['twitter'])
        <li class="s-sidebar-socials__item">
          <a class="btn btn--social" href="{{ $options['twitter'] }}" target="_blank">
            @icon('x-twitter')
          </a>
        </li>
      @endif
      @if($options['youtube'])
        <li class="s-sidebar-socials__item">
          <a class="btn btn--social" href="{{ $options['youtube'] }}" target="_blank">
            @icon('youtube')
          </a>
        </li>
      @endif
    </ul>
</section>

<section class="s-topheader">
  <ul class="s-topheader-socials">
    @if($options['linkedin'])
      <li class="s-topheader-socials__item">
        <a class="btn btn--social" href="{{ $options['linkedin'] }}" target="_blank">
          @icon('linkedin')
        </a>
      </li>
    @endif
    @if($options['instagram'])
      <li class="s-topheader-socials__item">
        <a class="btn btn--social" href="{{ $options['instagram'] }}" target="_blank">
          @icon('instagram')
        </a>
      </li>
    @endif
    @if($options['facebook'])
      <li class="s-topheader-socials__item">
        <a class="btn btn--social" href="{{ $options['facebook'] }}" target="_blank">
          @icon('facebook')
        </a>
      </li>
    @endif
    @if($options['twitter'])
      <li class="s-topheader-socials__item">
        <a class="btn btn--social" href="{{ $options['twitter'] }}" target="_blank">
          @icon('x-twitter')
        </a>
      </li>
    @endif
    @if($options['youtube'])
      <li class="s-topheader-socials__item">
        <a class="btn btn--social" href="{{ $options['youtube'] }}" target="_blank">
          @icon('youtube')
        </a>
      </li>
    @endif
  </ul>
</section>

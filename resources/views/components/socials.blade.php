<ul class="c-socials">
  @if($options['linkedin'])
    <li class="c-socials__item">
      <a class="btn btn--social" href="{{ $options['linkedin'] }}" target="_blank">
        <div class="btn-title">
          <div class="btn-title__item">@icon('linkedin')</div>
          <div class="btn-title__item">@icon('linkedin')</div>
        </div>
      </a>
    </li>
  @endif
  @if($options['instagram'])
    <li class="c-socials__item">
      <a class="btn btn--social" href="{{ $options['instagram'] }}" target="_blank">
        <div class="btn-title">
          <div class="btn-title__item">@icon('instagram')</div>
          <div class="btn-title__item">@icon('instagram')</div>
        </div>
      </a>
    </li>
  @endif
  @if($options['facebook'])
    <li class="c-socials__item">
      <a class="btn btn--social" href="{{ $options['facebook'] }}" target="_blank">
        <div class="btn-title">
          <div class="btn-title__item">@icon('facebook')</div>
          <div class="btn-title__item">@icon('facebook')</div>
        </div>
      </a>
    </li>
  @endif
  @if($options['twitter'])
    <li class="c-socials__item">
      <a class="btn btn--social" href="{{ $options['twitter'] }}" target="_blank">
        <div class="btn-title">
          <div class="btn-title__item">@icon('x-twitter')</div>
          <div class="btn-title__item">@icon('x-twitter')</div>
        </div>
      </a>
    </li>
  @endif
  @if($options['youtube'])
    <li class="c-socials__item">
      <a class="btn btn--social" href="{{ $options['youtube'] }}" target="_blank">
        <div class="btn-title">
          <div class="btn-title__item">@icon('youtube')</div>
          <div class="btn-title__item">@icon('youtube')</div>
        </div>
      </a>
    </li>
  @endif
</ul>

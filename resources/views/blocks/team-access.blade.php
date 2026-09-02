<section class="s-team {{ $classes }}" style="{{ $styles }}">
	<div class="container">

		<x-title_text name="s-team" :title="$title" :description="$description"/>

		<div class="s-team-list">
			@if(count($teams) <= 3)
				<div class="s-team-list-wrapper">
					@foreach($teams as $team)
						<div class="c-team" animation-stagger>
							<x-media :media="$team['image']"/>
							<h3 class="c-team__title">{{ $team['name'] }}</h3>
							<div class="c-team__text">{{ $team['job'] }}</div>
						</div>
					@endforeach
				</div>
			@else
				<x-slider
						name="team"
						:per="3"
						:perMd="3"
						:perSm="2"
						:perXs="1"
						:modules="['navigation']"
						:extra="['spaceBetween' => 20]"
				>
					@foreach($teams as $team)
						<div class="swiper-slide">
							<div class="c-team" animation-stagger>
								<x-media :media="$team['image']"/>
								<h3 class="c-team__title">{{ $team['name'] }}</h3>
								<div class="c-team__text">{{ $team['job'] }}</div>
							</div>
						</div>
					@endforeach
				</x-slider>
			@endif
    </div>
  </div>
</section>

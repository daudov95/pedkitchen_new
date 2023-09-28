@extends('layouts.app')


@section('header')
	@include('parts.header')
@endsection


@section('styles')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
@endsection


@section('content')
	<main class="main">
		<div class="block-info">
			<div class="container">
				<div class="block-info__wrap">
					<div style="display: flex; flex-direction: column;">
						<span class="block-info__text"><span class="block-info__text--highlight">Педагогическая кухня учителя будущего</span></span>
						<span style="margin-top: 10px">Здесь мы готовим учителей будущего</span>
					</div>
					<a href="#" class="block-info__link">Подробнее</a>
				</div>
			</div>
		</div>


		<div class="banner">
			<div class="container">

				<div class="banner__wrap">
					<!-- Slider main container -->
					<div class="swiper swiper-banner">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
						<!-- Slides -->

						@if ($banners)
							@foreach ($banners as $banner)

								<div class="swiper-slide">
									@if ($banner->link)
										<a href="{{ $banner->link }}"><img src="{{ asset('storage/'.$banner->image) }}" alt="Banner"></a>
									@else
										<img src="{{ asset('storage/'.$banner->image) }}" alt="Banner">
									@endif
								</div>
								
							@endforeach
							
						@endif
						
	
						</div>
						<!-- If we need pagination -->
						<div class="swiper-pagination"></div>
					
						<!-- If we need navigation buttons -->
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>

					</div>
					
				</div>
			</div>
		</div>


		@if ($menu)

			@foreach ($menu as $item)
				<section class="section section-block {{ $loop->even ? 'section-block--reverse' : '' }}">
					<div class="container">
						<div class="section-block__wrap">

							
							<div class="section-block__left">
								<h3 class="section-block__title">{{ $item->title }}</h3>

								<div>{!! $item->content !!}</div>
							

								<div class="section-block-links">
									<a href="{{ route('subscribe', ['category' => $item->id]) }}" class="section-block__link section-block__link-primary">Подписаться на обновления</a>
									<a href="{{ route('posts', ['category' => $item->id]) }}" class="section-block__link">Перейти к рецептам <span>→</span></a>
								</div>
							</div>

							<div class="section-block__right">
								<img src="{{ asset('storage/'. $item->image) }}" alt="screen">
							</div>

						</div>
					</div>
				</section>
			@endforeach
			
		@endif

	</main>
@endsection

@section('footer')
	@include('parts.footer')
@endsection

@section('menu')
	@include('parts.menu')
@endsection

@section('scripts')
	<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>

	<script>
		const swiper = new Swiper('.swiper-banner', {
			loop: true,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			effect: 'cube',
			cubeEffect: {
				slideShadows: false,
			},
			autoplay: {
				delay: 5000,
			},
		});
	</script>

@endsection
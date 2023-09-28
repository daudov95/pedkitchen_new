@extends('layouts.app')

@section('header')
	@include('parts.header')
@endsection


@section('content')
    
<main class="main">

	<section class="section-faq faq">
		<div class="container">
			<div class="faq__wrap">
				

				<div class="faq-block">
					<div class="faq-block__left">
						<h1 class="faq__title">Контакты</h1>
						<div class="about-block-row">
							<span class="about-block__title">Телефон:</span>
							<a href="tel:+7(800) 555-35-35">+7(800) 555-35-35</a>
						</div>

						<div class="about-block-row">
							<span class="about-block__title">Телефон:</span>
							<a href="mailto:pedkitchen@chspu.ru">pedkitchen@chspu.ru</a>
						</div>

						<div class="about-block-row">
							<span class="about-block__title">Адрес:</span>
							<span>364031, Северо-Кавказский федеральный округ, Чеченская Республика, г. Грозный пр. Х. Исаева, 62</span>
						</div>
					</div>
					<div class="faq-block__right">
						<div class="faq-block__img">
							<img src="https://chspu.ru/wp-content/uploads/2022/02/photo1642591071-1.jpeg" alt="IMG">
						</div>
					</div>
				</div>

				<style>
					.about-block {
						display: flex;
					}
					.about-block__left, .about-block__right {
						width: 50%;
					}
				</style>


				<div class="about-block">
					
					<iframe src="https://yandex.ru/map-widget/v1/?lang=ru_RU&amp;scroll=true&amp;um=constructor%3A11b3f4ec6286801cd4187abe4e51b2cd5ecdcbe19e0ad4a5d3ce798ebdfb700f" frameborder="0" allowfullscreen="true" width="100%" height="595px" style="display: block;"></iframe>

				</div>
				
				
				{{-- @if (count($faqs))
					<div class="accordion">
						@foreach ($faqs as $faq)
							<div class="accordion__item">
								<div class="accordion__header">
									{{ $faq->title }}
								</div>
								<div class="accordion__body">
									<div class="accordion__content">
										{{ $faq->desc }}
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@endif --}}
				
			</div>
			
		</div>
	</section>

</main>

@endsection


@section('footer')
	@include('parts.footer')
@endsection

{{-- 
@section('menu')
	@include('parts.menu')
@endsection --}}

@section('scripts')
	<script src="{{ asset('assets/js/accordion.js') }}"></script>

	<script>
		let accordion = new ItcAccordion(document.querySelector('.accordion'), {
		  alwaysOpen: false
		});
	</script>
@endsection
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
						<h1 class="faq__title">Часто задаваемые вопросы</h1>
						<p class="faq__desc">
							Далеко-далеко за словесными, горами в стране гласных и согласных живут рыбные тексты. Там снова дороге рыбными назад проектах вопроса меня, дал предупреждал маленькая, буквоград она даль текста букв всемогущая которое на берегу это наш моей ручеек ведущими lorem встретил курсивных родного? Силуэт напоивший выйти что, взгляд над составитель, себя, текстов продолжил дороге за свой мир проектах строчка речью до всемогущая если рыбного послушавшись образ.
						</p>
					</div>
					<div class="faq-block__right">
						<div class="faq-block__img">
							<img src="https://chspu.ru/wp-content/uploads/2022/02/photo1642591071-1.jpeg" alt="IMG">
						</div>
					</div>
				</div>
				
				
				@if (count($faqs))
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
				@endif
				
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
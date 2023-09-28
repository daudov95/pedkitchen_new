@extends('layouts.app')

{{-- @section('styles')
	<style>
		.subscribe__right {
			background-image: url({{ asset('assets/img/subscribe/bg2.png') }});
		}
	</style>
	
@endsection --}}

@section('content')
    <main class="main subscribe__main">
		
		<div class="subscribe">
			<div class="subscribe__left">

				@if(Session::has('success'))
					<div class="alert alert-success">
						{{ Session::get('success')}}
					</div>
				@endif

				@if ($errors->any())
					<div class="alert alert-danger">
						<ul style="margin-bottom: 0px">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<style>
					.subscribe-form__textarea {
						min-height: 130px;
						padding: 10px;
					}

					.subscribe-form__select {
						margin-bottom: 10px;
						height: 50px;
						font-size: 16px;
						padding-left: 10px;
						padding-right: 10px;
					}

					.authors-hide, .topic-hide {
						display: none;
					}

				</style>

				{{-- <h2 style="margin-bottom: 40px; font-size: 35px; text-align: center; line-height: 1.2;">Форма для ваших вопросов</h2> --}}

				<h1 class="subscribe__title">Получайте ответы на интересующие вас вопросы</h1>
				<form action="{{ route('contactForm.send') }}" method="POST" class="subscribe-form">
					@CSRF
					<input type="text" class="subscribe-form__input" placeholder="Ваше имя" name="name" value="{{ old('name') }}">
					<input type="email" class="subscribe-form__input" placeholder="Ваш Email" name="email" value="{{ old('email') }}">

					<select name="topic_select" class="subscribe-form__select topic-select">
						<option>Выберете тему</option>
						<option @if(old('topic_select') == 1) selected @endif value="1">Консультация</option>
						<option @if(old('topic_select') == 2) selected @endif value="2">Другая тема</option>
					</select>

					{{-- @if (old('authors')) --}}
						<select name="authors" class="subscribe-form__select authors authors-hide">
							<option value="0">Выберете из списка</option>

							@if (count($consultants))
								@foreach ($consultants as $c)
									<option value="{{ $c->id }}">{{ $c->name }}</option>
								@endforeach
							@endif
							
						</select>
					{{-- @endif --}}

					{{-- @if (old('topic')) --}}
						<input type="text" class="subscribe-form__input topic topic-hide" placeholder="Тема" name="topic" value="{{ old('topic') }}">
					{{-- @endif --}}


					<textarea name="message" class="subscribe-form__input subscribe-form__textarea" placeholder="Ваш вопрос" cols="30" rows="10">{{ old('message') }}</textarea>
					{{-- <label for="cb" class="subscribe-form__label">
						<input type="checkbox" name="checkbox" id="cb" name="checkbox" {{ old('checkbox') == 'on' ? 'checked' : '' }} class="subscribe-form__checkbox">
						Я согласен получать рассылки от сайта на электронную почту
					</label> --}}
					<button class="subscribe-form__btn">Отправить</button>
				</form>
				<a href="{{ route('index') }}" class="subscribe__policy">Назад</a>
			</div>
			<div class="subscribe__right"></div>
		</div>
	
	</main>
@endsection


@section('scripts')
	<script>
		const topicSelect = document.querySelector('.topic-select');
		

		topicSelect.addEventListener('change', (e) => {
			const value = Number(e.target.value);
			let html = '';

			const authors = document.querySelector('.authors');
			const topicInput = document.querySelector('.topic');
			// console.log(value);

			if(value) {
				authors.classList.add('authors-hide');
				authors.value = 0;
				topicInput.classList.add('topic-hide');
				topicInput.value = '';
				
				if(value == 1) {
					// html = `
					// <select name="authors" class="subscribe-form__select authors">
					// 	<option>Выберете из списка</option>
					// 	<option value="1">Алихан Динаев</option>
					// 	<option value="2">Исмаил Байханов</option>
					// 	</select>
					// 	`;
					// console.log(topicInput.classList.contains('topic-hide'));

					// topicInput.classList.remove('topic-hide'); //if(!topicInput.classList.contains('topic-hide')) 
					authors.classList.remove('authors-hide');
				}
				if(value == 2) {
					// html = `
					// 	<input type="text" class="subscribe-form__input topic__input" placeholder="Тема" name="topic" value="{{ old('topic') }}">
					// `
					// authors.classList.remove('authors-hide'); //if(!authors.classList.contains('authors-hide'))
					topicInput.classList.remove('topic-hide');
				}

				

				// topicSelect.insertAdjacentHTML('afterend', html);;
			}
			
		})

	</script>
@endsection
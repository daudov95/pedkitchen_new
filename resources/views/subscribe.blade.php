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

				<h2 style="margin-bottom: 40px; font-size: 35px; text-align: center; line-height: 1.2;">СЕРВИС БРОНИРОВАНИЯ</h2>

				<h1 class="subscribe__title">Получай педагогические рецепты в числе первых</h1>
				<form action="{{ route('subscribe.post') }}" method="POST" class="subscribe-form">
					@CSRF
					<input type="hidden" name="menu_id" value="{{ $data['menu_id'] }}">
					<input type="text" class="subscribe-form__input" placeholder="Ваше имя" name="name" value="{{ $data['name'] ?? old('name') }}">
					<input type="email" class="subscribe-form__input" placeholder="Email" name="email" value="{{ $data['email'] ?? old('email') }}">
					{{-- <input type="text" class="subscribe-form__input" placeholder="Телефон"> --}}
					<label for="cb" class="subscribe-form__label">
						<input type="checkbox" name="checkbox" id="cb" name="checkbox" {{ old('checkbox') == 'on' ? 'checked' : '' }} class="subscribe-form__checkbox">
						Я согласен получать рассылки от сайта на электронную почту
					</label>
					<button class="subscribe-form__btn">Отправить</button>
				</form>
				<span class="subscribe__notice">Нажимая на кнопку «Отправить», вы принимаете</span>
				<a href="#" class="subscribe__policy">Политику конфиденциальности и Лицензионное соглашение.</a>
				<a href="{{ route('index') }}" class="subscribe__policy">Назад</a>
			</div>
			<div class="subscribe__right"></div>
		</div>
	
	</main>
@endsection
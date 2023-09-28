@extends('layouts.app')

@section('content')

<main class="main subscribe__main">

    <style>
        .subscribe__form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* .subscribe__policy {
            line-height: 1;
        }

        .subscribe__notice {
            margin-top: 0;
            margin-bottom: 5px;
        }
        .mt-5 {
            margin-top: 10px;
            margin-bottom: 5px;
        } */
    </style>
		
    <div class="subscribe">
        <div class="subscribe__left">
            <h1 class="subscribe__title">Авторизация</h1>

            <form class="subscribe__form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="subscribe-form">
                    <input id="email" placeholder="Ваш Email" type="email" class="subscribe-form__input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <input id="password" placeholder="Ваш пароль" type="password" class="subscribe-form__input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    {{-- <input type="text" class="subscribe-form__input" placeholder="Телефон"> --}}
                    <label for="remember" class="subscribe-form__label">
                        {{-- <input type="checkbox" name="checkbox" id="cb" class="subscribe-form__checkbox"> --}}
                        <input class="subscribe-form__checkbox form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        Запомнить меня
                    </label>

                    {{-- <button class="subscribe-form__btn">Отправить</button> --}}
                    <button type="submit" class="subscribe-form__btn btn btn-primary">
                        Войти
                    </button>
                </div>

                @if (Route::has('password.request'))
                    <a class="subscribe__policy btn btn-link mt-5" href="{{ route('password.request') }}">
                        {{ __('Забыли пароль ?') }}
                    </a>
                @endif


                <a class="subscribe__policy btn btn-link" href="{{ route('register') }}">
                    {{ __('Создать аккаунт') }}
                </a>
                {{-- <span class="subscribe__notice">Нажимая на кнопку «Отправить», вы принимаете</span> --}}
                {{-- <a href="#" class="subscribe__policy">Политику конфиденциальности и Лицензионное соглашение.</a> --}}
                <a href="{{ route('index') }}" class="subscribe__policy">Назад</a>
            </form>
        </div>
        <div class="subscribe__right" style="background-image: url('../assets/img/subscribe/bg.jpg')"></div>
    </div>

</main>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

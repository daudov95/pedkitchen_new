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
    </style>
		
    <div class="subscribe">
        <div class="subscribe__left">
            <h1 class="subscribe__title">Восстановление</h1>

            <form class="subscribe__form" method="POST" action="{{ route('password.email') }}">
                @csrf


                <div class="subscribe-form">

                    <input id="email" placeholder="Ваш Email" type="email" class="subscribe-form__input form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    <button type="submit" class="subscribe-form__btn btn btn-primary">
                        Восстановить
                    </button>
                    
                </div>

                <a class="subscribe__policy btn btn-link" href="{{ route('login') }}">
                    {{ __('Вернуться назад') }}
                </a>

            </form>
        </div>
        <div class="subscribe__right"></div>
    </div>

</main>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

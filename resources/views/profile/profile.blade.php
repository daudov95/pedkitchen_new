@extends('layouts.app')

@section('content')
	<main class="main archive__main">
		<div class="archive">
			
			@include('parts.side')
			
			<div class="archive__right">
				<div class="archive-block">
					<h2 class="archive__title archive__title--right" style="display:flex;width:100%;justify-content: space-between;">
                        Профиль - {{ auth()->user()->name }}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Выйти</button>
                        </form>
					</h2>
				</div>
				<div class="archive-filter">
					
				</div>

				<div class="archive-profile-info">
                    <h3>Статистика:</h3>
                    <span>Вы зарегистрировались: {{ auth()->user()->created_at?->format('d.m.Y') }}</span>
				</div>

			</div>
		</div>
	</main>
@endsection
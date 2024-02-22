@extends('layouts.app')

@section('content')
	<main class="main archive__main">
		<div class="archive">
			
			@include('parts.side')
			
			<div class="archive__right">
				<div class="archive-block">
					<h2 class="archive__title archive__title--right" style="display:flex;width:100%;justify-content: space-between;">
						Настройки
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Выйти</button>
                        </form>
					</h2>
				</div>
				<div class="archive-filter">
					
				</div>

				<div class="archive-profile-settings">
                    <h3>Изменение:</h3>
                    <span>Новый e-mail: <input type="text" placeholder="Введите e-mail"></span>
                    <span>Новый пароль: <input type="text" placeholder="Введите пароль"></span>
				</div>

			</div>
		</div>
	</main>
@endsection
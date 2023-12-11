@extends('layouts.app')

@section('content')
	<main class="main archive__main">

		
		<div class="archive post-single">

			@include('pages.cookbook.side')
			
			<div class="archive__right">
				<div class="archive-block">
					<h2 class="archive__title archive__title--right">
					@if ($post->title)
						{{ $post->title }}
					@endif
					</h2>
				</div>
				<div class="archive-filter">
					<ul class="archive-filter__list">
						<li class="archive-filter__item">
							<span class="post-single__label">Год издания: </span>
							<span>{{ $post->year ?: 'Не указано' }}</span>
						</li>
						<li class="archive-filter__item">
							
								@if ($post->authors && count($post->authors) == 1)
									<span class="post-single__label">Автор:</span>
								@endif
							
							<span>
								@if ($post->authors)

									@if (count($post->authors) > 1)
										{{-- Множество авторов --}}
										Авторы: {{ $post->authors->map(fn($item) => $item->name)->implode(', ') }}
									@elseif(count($post->authors) == 1)
										@foreach ($post->authors as $key => $author)
											{{$author->name}}
										@endforeach
									@else 
										Не указан
									@endif
									
								@endif
							</span>
						</li>

						{{-- @if (auth()->check()) --}}
							{{-- <li class="archive-filter__item">
								<a href="?Add">
									<span>Добавить в «Мои избранные»</span>
								</a>
							</li> --}}
						{{-- @endif --}}
						
					</ul>
				</div>

				
				<div class="post-single-content">

					<div class="post-single-content__img" style="width: 500px">
						<img src="{{ asset('storage/'.$post->image) }}">
					</div>
					<h1 style="margin-bottom: 15px; line-height:1">{{ $post->title }}</h1>

					<p style="margin-bottom: 15px;">{{ $post->desc }}</p>

					{{-- <span>
						@if ($post->authors)

							@if (count($post->authors) > 1)
								Авторы: {{ $post->authors->map(fn($item) => $item->name)->implode(', ') }}
							
							@elseif(count($post->authors) == 1)
								@foreach ($post->authors as $key => $author)
									{{$author->name}}
								@endforeach
							@else 
								Не указан
							@endif
							
						@endif
					</span> --}}

					<a href="{{ asset('storage/'.$post->document) }}" target="__blank" style="text-decoration: underline">Посмотреть полностью</a>
				</div>
				

			</div>
		</div>

	</main>

@endsection

@section('scripts')
	<script>
		// получаем массив всех вкладок
		const tabs = document.querySelectorAll(".tab");
		// получаем массив всех блоков с содержимым вкладок
		const contents = document.querySelectorAll(".content");
		
		// запускаем цикл для каждой вкладки и добавляем на неё событие
		for (let i = 0; i < tabs.length; i++) {
			tabs[i].addEventListener("click", ( event ) => {
		
				// сначала нам нужно удалить активный класс именно с вкладок
				let tabsChildren = event.target.parentElement.children;
				for (let t = 0; t < tabsChildren.length; t++) {
					tabsChildren[t].classList.remove("tab--active");
				}
				// добавляем активный класс
				tabs[i].classList.add("tab--active");
				// теперь нужно удалить активный класс с блоков содержимого вкладок
				let tabContentChildren = event.target.parentElement.nextElementSibling.children;
				for (let c = 0; c < tabContentChildren.length; c++) {
					tabContentChildren[c].classList.remove("content--active");
				}
				// добавляем активный класс
				contents[i].classList.add("content--active");
		
			});
		}
		
	</script>
@endsection
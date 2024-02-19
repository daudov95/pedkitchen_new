@extends('layouts.app')

@section('content')
	<main class="main archive__main">

		
		<div class="archive post-single">

			@include('pages.cookbook.diagnostic.side')
			
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
						{{-- <li class="archive-filter__item">
							<span class="post-single__label">Год издания: </span>
							<span>{{ $post->year ?: 'Не указано' }}</span>
						</li> --}}
						{{-- <li class="archive-filter__item">
							
								@if ($post->authors && count($post->authors) == 1)
									<span class="post-single__label">Автор:</span>
								@endif
							
							<span>
								@if ($post->category)
								{{ $post->category->title }}
								@endif
							</span>
						</li> --}}

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

					<a href="{{ asset('storage/'.$post->document) }}" target="__blank" style="text-decoration: underline">Посмотреть полностью</a>
				</div>
				

			</div>
		</div>

	</main>

@endsection
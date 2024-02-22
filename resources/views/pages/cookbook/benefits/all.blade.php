@extends('layouts.app')

@section('content')

	<style>
		.archive-post__favorite {
			position: absolute;
			top: 10px;
			right: 10px;
			width: 30px !important;
			height: 30px !important;
			cursor: pointer;
			opacity: 0;
			transition: .3s opacity;
		}

		.archive-post__favorite img {
			display: flex;
			width: 20px;
			height: 20px;
			object-fit: contain;
		}

		.archive-post:hover .archive-post__favorite {
			opacity: 1;
		}
	</style>

	<main class="main archive__main">
		
		<div class="archive">
			
			@include('pages.cookbook.benefits.side')
			
			<div class="archive__right">
				<div class="archive-block">
					<h2 class="archive__title archive__title--right">
						@if (isset($category))
							{{ $category->title }}
						@else
							Менюборд
						@endif
					</h2>
					@if (auth()->check())
						<div class="archive-block-auth">
							<h3 class="archive-block-auth__name"><a href="{{ route('profile.favorites') }}">Мой аккаунт</a></h3>
						</div>
					@endif
				</div>
				<div class="archive-filter">
					{{-- <ul class="archive-filter__list">

						<li class="archive-filter__item">
							<span>Фильтр</span>
						</li>
					</ul> --}}
				</div>

				<div class="archive-posts">
					@if (count($posts))
					@foreach ($posts as $post)
					<div class="archive-post">
						<div class="archive-post__img">
							<img src="{{ asset('storage/'.$post->image) }}" alt="IMG">
						</div>
						<h4 class="archive-post__title">{{ $post->title }}</h4>
						<span class="archive-post__category">Категория: {{ $post->category->title ?: 'Не указано' }}</span>

						<div class="archive-post-button">
							<span class="archive-post__author"> 
								
								@if ($post->authors)

									@if (count($post->authors) > 1)
										Множество авторов
									@elseif(count($post->authors) == 1)
										@foreach ($post->authors as $key => $author)
											Автор: {{$author->name}}
										@endforeach
									@else 
										Автор: Не указан
									@endif
									
								@endif
								
								</span>
								
							<a href="{{ route('cookbook.benefits.show', ['post'=> $post->id] ) }}" class="archive-post__btn">Перейти</a>
						</div>
					</div>
				@endforeach
					@else 
						<h2 style="margin-top: 50px;">Постов не найдено</h2>
					@endif


					

				</div>

				<div class="archive-pagonation">
						<div class="archive-pagonation__wrap">
							{{ $posts->links() }}
						</div>
				</div>

			</div>
		</div>

	
	</main>

@endsection
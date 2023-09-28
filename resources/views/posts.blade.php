@extends('layouts.app')

@section('content')

	{{-- <style>

		.archive-block {
			justify-content: space-between;
		}

		.archive-block-auth__name {
			font-size: 20px;
    		font-weight: normal;
		}
	</style> --}}

	{{-- <style>
		.pagination {
			display: flex;
			padding-left: 0;
			list-style: none;
			border-radius: 0.25rem;
		}

		.page-link {
			position: relative;
			display: block;
			padding: 0.5rem 0.75rem;
			margin-left: -1px;
			line-height: 1.25;
			color: #007bff;
			background-color: #fff;
			border: 1px solid #dee2e6;
			height: 45px;
		}

		.page-item:first-child .page-link {
			margin-left: 0;
			border-top-left-radius: 0.25rem;
			border-bottom-left-radius: 0.25rem;
		}

		.page-item.disabled .page-link {
			color: #6c757d;
			pointer-events: none;
			cursor: auto;
			background-color: #fff;
			border-color: #dee2e6;
			height: 45px;
		}

		.page-item.active .page-link {
			z-index: 3;
			color: #fff;
			background-color: #007bff;
			border-color: #007bff;
			height: 45px;
		}

		.archive-pagonation {
			display: flex;
			padding: 0 15px;
			margin: 0 auto;

			margin-bottom: 30px; /* Перенести в стили */
		}

		.archive-pagonation__wrap {
			display: flex;
			justify-content: space-between;
		}

		.archive-pagonation__wrap > div:first-child {
			display: none;
		}

	</style> --}}


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
			
			@include('parts.side')
			
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
					<ul class="archive-filter__list">

						<li class="archive-filter__item">
							<span>Фильтр</span>
						</li>

						{{-- <select id="a-select" multiple="multiple">
							<option data-display="Select">все</option>
							<option value="1">по учебному предмету</option>
							<option value="2">по классу</option>
							<option value="3">по уровню образования</option>
							<option value="4">по категориям обучающихся</option>
						</select> --}}

						{{-- <li class="archive-filter__item">
							<span>Подобрать педагогические ситуации</span>
						</li>
						<li class="archive-filter__item">
							<label for="cb1">
								по учебному предмету
								<input type="checkbox" name="cb1" id="cb1">
							</label>
						</li>
						<li class="archive-filter__item">
							<label for="cb2">
								по классу
								<input type="checkbox" name="cb2" id="cb2">
							</label>
						</li>
						<li class="archive-filter__item">
							<label for="cb3">
								по уровню образования
								<input type="checkbox" name="cb3" id="cb3">
							</label>
						</li>
						<li class="archive-filter__item">
							<label for="cb4">
								по категориям обучающихся
								<input type="checkbox" name="cb4" id="cb4">
							</label>
						</li> --}}
					</ul>
				</div>

				<div class="archive-posts">
					@if (count($posts->items()))
						@foreach ($posts as $post)
							<div class="archive-post">
								<div class="archive-post__img">
									<img src="{{ asset('storage/'.$post->image) }}" alt="IMG">
									<button class="archive-post__favorite">
										<img src="{{ asset('assets/img/archive/icons/icon3.png') }}" alt="add to favorite" >
									</button>
								</div>
								<h4 class="archive-post__title">{{ $post->title }}</h4>
								<span class="archive-post__category">Категория: {{ $post->category_id ? $post->category->title : 'Не указано' }}</span>

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
										
									<a href="{{ route('post', ['category'=> $parentCategory, 'subcategory'=> $post->category_id, 'post' => $post->id] ) }}" class="archive-post__btn">Перейти</a>
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
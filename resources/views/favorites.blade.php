@extends('layouts.app')

@section('content')

	<main class="main archive__main">
		
		<div class="archive">
			
			@include('parts.side')
			
			<div class="archive__right">
				<div class="archive-block">
					<h2 class="archive__title archive__title--right">
						@if (isset($category))
							{{ $category->title }}
						@else
							Избранные
						@endif
					</h2>
				</div>
				<div class="archive-filter">
					<ul class="archive-filter__list">
						<li class="archive-filter__item">
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
						</li>
					</ul>
				</div>

				<div class="archive-posts">

					@if (isset($posts))
					
						@foreach ($posts as $post)
							<div class="archive-post">
								<div class="archive-post__img">
									<img src="{{ $post->image }}" alt="IMG">
								</div>
								<h4 class="archive-post__title">{{ $post->title }}</h4>
								<span class="archive-post__category">Категория: {{ $post->category->title }}</span>

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
									<a href="{{ route('post.free', ['post' => $post->id] ) }}" class="archive-post__btn">Перейти</a>
								</div>
							</div>
						@endforeach

						
					@endif


				</div>

				{{-- <div class="archive-pagonation">

					<div class="archive-pagonation__list">
						<a href="#">«</a>
						<a href="#">1</a>
						<a href="#" class="active">2</a>
						<a href="#">3</a>
						<a href="#">4</a>
						<a href="#">5</a>
						<a href="#">6</a>
						<a href="#">»</a>
					</div>
				</div> --}}

			</div>
		</div>

	
	</main>

@endsection
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
			
			@include('parts.side')
			
			<div class="archive__right">
				<div class="archive-block">
					<h2 class="archive__title archive__title--right" style="display:flex;width:100%;justify-content: space-between;">
						Избранные
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Выйти</button>
                        </form>
					</h2>
				</div>
				<div class="archive-filter">
					{{-- <ul class="archive-filter__list">
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
					</ul> --}}
				</div>

				<div class="archive-posts">

					@if (isset($posts))
					
						@foreach ($posts as $post)
							<div class="archive-post">
								<div class="archive-post__img">
									<img src="{{ asset('storage/'.$post->image) }}" alt="IMG">

									{{-- @if (auth()->user() && !$my_favorites->filter(fn ($p) => $p->id == $post->id)->first()) --}}
										<button class="archive-post__favorite" data-post-id="{{ $post->id }}">
											<img src="{{ asset('assets/img/archive/icons/remove-icon.svg') }}" alt="remove from favorites" >
										</button>
									{{-- @endif --}}
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

				<div class="archive-pagonation">
					<div class="archive-pagonation__wrap">
						{{ $posts->links() }}
					</div>
				</div>

			</div>
		</div>

	
	</main>

@endsection


@if (auth()->user())
	@section('scripts')
		<script>
			const removeFromFavorite = document.querySelectorAll('.archive-post__favorite');

			removeFromFavorite.forEach(btn => btn.addEventListener('click', async (e) => {
				e.preventDefault();
				const target = e.currentTarget;
				const data = {post_id: target.dataset.postId, user_id: {{ auth()->user()->id ?? null }}};

				// return console.log(data);

				const headers = new Headers({
					'Content-Type': 'application/json'
				});
				
				let response = await fetch('/api/remove-favourite', {
					method: 'POST',
					body: JSON.stringify(data),
					headers: headers
				})
				response = await response.json();

				if(response.status) {
					alert(response.message);
					target.remove();
				}
				else {
					alert(response.message);
				}

			}))
		</script>
	@endsection
@endif
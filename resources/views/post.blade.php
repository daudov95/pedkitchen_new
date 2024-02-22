@extends('layouts.app')

@section('content')
	<main class="main archive__main">

		
		<div class="archive post-single">

			@include('parts.side')
			
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
							<span class="post-single__label">Категория:</span>
							<span>{{ $post->category ? $post->category->title : 'Не указано' }}</span>
						</li>
						<li class="archive-filter__item">
							
								@if ($post->authors && count($post->authors) == 1)
									<span class="post-single__label">Автор:</span>
								@endif
							
							<span>
								@if ($post->authors)

									@if (count($post->authors) > 1)
										Множество авторов
									@elseif(count($post->authors) == 1)
										@foreach ($post->authors as $key => $author)
											{{$author->name}}
										@endforeach
									@else 
										Не указан
									@endif
									
								@endif
								{{-- {{ $author ? $author->name : 'Не указан' }} --}}
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

					@if (!$post->is_video)
						<div class="post-single-content__img">
							<img src="{{ asset('storage/'.$post->image) }}">
						</div>
						<h1>{{ $post->title }}</h1>

						@if($post->tab1_title)
							<div class="tabs">
								<ul class="container--tabs">
									<li class="tab tab--active">{{ $post->tab1_title }}</li>
									@if($post->tab2_title)<li class="tab">{{ $post->tab2_title }}</li>@endif
									@if($post->tab3_title)<li class="tab">{{ $post->tab3_title }}</li>@endif
									@if($post->tab4_title)<li class="tab">{{ $post->tab4_title }}</li>@endif
								</ul>
					
								<div class="container--content">
									<div class="content content--active">
										<p>{{ $post->tab1_desc }}</p>
									</div>
									@if($post->tab2_desc)
										<div class="content">
											<p>{{ $post->tab2_desc }}</p>
										</div>
									@endif
									@if($post->tab3_desc)
										<div class="content">
											<p>{{ $post->tab3_desc }}</p>
										</div>
									@endif
									@if($post->tab4_desc)
										<div class="content">
											<p>{{ $post->tab4_desc }}</p>
										</div>
									@endif
								</div>
							</div>

						@endif
						
					@endif
					
					@if ($post->is_video)
						<div>
							{{-- <video
								width="1000px"
								controls>
								<source
									src="{{ $post->video }}"
									type="video/mp4" />
								Your browser doesn't support HTML5 video tag.
								</video> --}}
								<iframe width="1000" height="600" src="{{ $post->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
						<div>{{ $post->video_desc }}</div>
					@endif
					

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
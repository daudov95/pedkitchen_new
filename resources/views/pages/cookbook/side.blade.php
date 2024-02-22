<div class="archive__left">
    <div class="archive-block">
        <h1 class="archive__title"><a href="{{ route('index') }}">ПЕДАГОГИЧЕСКАЯ КУХНЯ <span>УЧИТЕЛЯ БУДУЩЕГО</span></a></h1>
    </div>
    
    @if(isset($menu))
        <ul class="archive-menu">
            <li class="archive-menu__item"><a href="{{ route('index') }}" class="archive-menu__link" style="background-image: url({{ asset('assets/img/archive/icons/icon-home.png') }})">Главная</a></li>
            <li class="archive-menu__item"><a href="{{ route('cookbook.monographs') }}" class="archive-menu__link {{ !isset($category) ? 'active' : '' }}" style="background-image: url({{ asset('assets/img/archive/icons/icon1.png') }})">Менюборд</a></li>

            

            @foreach ($menu as $item)

                <li class="archive-menu__item">

                    <a href="{{ route('cookbook.category.monographs', ['category'=> $item->id]) }}" class="archive-menu__link {{ isset($category) && isset($post) && $item->id == $post->category_id ? 'active': '' }} {{ isset($category) && $item->id == $category->id ? 'active': '' }}" style='background-image:url("{{ asset("storage/image/icon-monograph.png") }}")'>
                        {{$item->title}}
                    </a>
                </li> 
            @endforeach
                {{-- @if (auth()->check()) --}}
                    {{-- <li class="archive-menu__item"><a href="{{ route('profile.favorites') }}" class="archive-menu__link archive--icon-wishlist">Мои избранные</a></li>  --}}
                {{-- @endif --}}
        </ul>
    @endif

</div>
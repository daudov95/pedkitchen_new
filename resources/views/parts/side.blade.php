<div class="archive__left">
    <div class="archive-block">
        <h1 class="archive__title"><a href="{{ route('index') }}">ПЕДАГОГИЧЕСКАЯ КУХНЯ <span>УЧИТЕЛЯ БУДУЩЕГО</span></a></h1>
    </div>
    
    @if(isset($menu))
        <ul class="archive-menu">
            <li class="archive-menu__item"><a href="{{ route('index') }}" class="archive-menu__link" style="background-image: url({{ asset('assets/img/archive/icons/icon-home.png') }})">Главная</a></li>
            <li class="archive-menu__item"><a href="{{ route('posts', ['category' => $parentCategory]) }}" class="archive-menu__link {{ !isset($category) ? 'active' : '' }}" style="background-image: url({{ asset('assets/img/archive/icons/icon1.png') }})">Менюборд</a></li>

            

            @foreach ($menu as $item)

                <li class="archive-menu__item">

                    <a href="{{ route('posts.subcategory', ['category'=> $item->parent_id, 'subcategory' => $item->id]) }}" class="archive-menu__link {{ isset($category) && isset($post) && $item->id == $post->submenu_id ? 'active': '' }} {{ isset($category) && $item->id == $category->id ? 'active': '' }}" {!! isset($item->icon) ? "style='background-image:url(". asset("storage/".$item->icon).") !important' " : '' !!} >
                        {{$item->title}}
                    </a>
                </li> 
            @endforeach
                {{-- @if (auth()->check()) --}}
                    <li class="archive-menu__item"><a href="{{ route('profile.favorites') }}" class="archive-menu__link archive--icon-wishlist">Мои избранные рецепты</a></li> 
                {{-- @endif --}}
        </ul>
    @endif

    @include('parts.profile.menu')
    
    {{-- <ul class="archive-menu">
        <li class="archive-menu__item"><a href="#" class="archive-menu__link archive--icon1 active2">Менюборд</a></li>
        <li class="archive-menu__item"><a href="#" class="archive-menu__link archive--icon2">Педагогические ситуации и их решения</a></li>
        <li class="archive-menu__item"><a href="#" class="archive-menu__link archive--icon3">Мои избранные рецепты</a></li>
    </ul> --}}

</div>
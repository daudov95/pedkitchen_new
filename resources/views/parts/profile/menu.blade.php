@if(isset($profile))
    <ul class="archive-menu">
        <li class="archive-menu__item"><a href="{{ route('profile.favorites') }}" class="archive-menu__link archive--icon-wishlist">Мой профиль</a></li> 
        <li class="archive-menu__item"><a href="{{ route('profile.favorites') }}" class="archive-menu__link archive--icon-wishlist">Мои настройки</a></li> 
        <li class="archive-menu__item"><a href="{{ route('profile.favorites') }}" class="archive-menu__link archive--icon-wishlist {{ request()->routeIs('profile.favorites') ? 'active' : '' }}">Мои избранные рецепты</a></li> 
    </ul>
@endif
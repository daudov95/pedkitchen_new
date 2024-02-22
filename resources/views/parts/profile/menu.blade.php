@if(isset($profile))
    <ul class="archive-menu">
        {{-- <li class="archive-menu__item"><a href="{{ route('profile.main') }}" class="archive-menu__link archive--icon-wishlist {{ request()->routeIs('profile.main') ? 'active' : '' }}">Мой профиль</a></li>  --}}
        {{-- <li class="archive-menu__item"><a href="{{ route('profile.settings') }}" class="archive-menu__link archive--icon-wishlist {{ request()->routeIs('profile.settings') ? 'active' : '' }}">Мои настройки</a></li>  --}}
        <li class="archive-menu__item"><a href="{{ route('profile.favorites') }}" class="archive-menu__link archive--icon-wishlist {{ request()->routeIs('profile.favorites') ? 'active' : '' }}">Мои избранные рецепты</a></li>
        @if (auth()->user()->is_admin)
            <li class="archive-menu__item"><a href="{{ route('admin.main') }}" class="archive-menu__link archive--icon-wishlist">Админка</a></li> 
        @endif
    </ul>
@endif
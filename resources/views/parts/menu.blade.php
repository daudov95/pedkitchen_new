<div class="mobile-menu">
    <a href="#" class="mobile-menu__close">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
        width="25" height="25"
        viewBox="0 0 50 50"
        style=" fill:#fff;"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path>
        </svg>
    </a>

    <div class="mobile-menu__block">
        <h5 class="mobile-menu__title">Меню сайта</h5>
        <ul class="mobile-menu__list">
            <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">О нашей кухне</a></li>
            <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Задать вопрос</a></li>
            <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Часто задаваемые вопросы</a></li>
            <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Контакты</a></li>
        </ul>
    </div>

    <div class="mobile-menu__block">
        <h5 class="mobile-menu__title">Меню кухни</h5>
        @if ($menu)
        <ul class="mobile-menu__list">
			@foreach ($menu as $item)
                <li class="mobile-menu__item"><a href="{{ route('posts', ['category' => $item->id]) }}" class="mobile-menu__link">{{ $item->title }}</a></li>
            @endforeach
        </ul>
        @endif
    </div>


    <div class="mobile-menu__block" style="border-top: 1px solid white; padding-top: 10px;">
        <ul class="mobile-menu__list">
            <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Кухонный инвентарь</a></li>
            <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Поваренные книги</a></li>
            <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Еда с доставкой</a></li>
            <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Праздничное меню</a></li>
        </ul>
    </div>


</div>
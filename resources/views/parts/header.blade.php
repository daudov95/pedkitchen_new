<header class="header">
		
    <div class="container">
        <div class="header__wrap">
            <div class="header-logo">
                <a href="{{ route('index') }}" class="header-logo__link">ЧГПУ</a>
                <div class="header-logo-text">
                    <h1>ПЕДАГОГИЧЕСКАЯ КУХНЯ</h1>
                    <h2>Чеченского государственного педагогического университета</h2>
                </div>
            </div>

            <div class="header-menu">
                <ul class="header-menu__list">
                    <li class="header-menu__item"><a href="{{ route('contactForm.page') }}" class="header-menu__link">Задать вопрос</a></li>
                    <li class="header-menu__item"><a href="{{ route('faq.page') }}" class="header-menu__link">Часто задаваемые вопросы</a></li>
                    <li class="header-menu__item"><a href="{{ route('about.page') }}" class="header-menu__link">Контакты</a></li>
                    <li class="header-menu__item"><a href="{{ route('login') }}" class="header-menu__link">Личный кабинет</a></li>
                </ul>
            </div>
        </div>
        <div class="header-menu-burger__wrap">
            <div class="header-menu-burger">
                <div class="header-menu-burger__btn-wrap">
                    <span class="header-menu-burger__btn"></span>
                    <span class="header-menu-burger__btn"></span>
                    <span class="header-menu-burger__btn"></span>
                </div>
                
                <span class="header-menu-burger__text">Меню</span>
            </div>

            <div class="header-menu header-menu-second">
                <ul class="header-menu__list">
                    <li class="header-menu__item">
                        <a href="#" class="header-menu__link">Кухонный инвентарь</a>
                        <ul>
                            <li><a href="https://chspu.ru/technopark/">Технопарк универсальных педагогических компетенций</a></li>
                            <li><a href="https://chspu.ru/kvantorium/">Педагогический технопарк «Кванториум» имени профессора Ш. М-Х. Арсалиева</a></li>
                            <li><a href="https://chspu.ru/центр-продуктивного-образования-эк/">Центр продуктивного образования “Эковерситет”</a></li>
                            <li><a href="#">Международная педагогическая мастерская победителей и лауреатов конкурсов «Учитель года» России, Беларуси и Казахстана</a></li>
                        </ul>
                    </li>
                    <li class="header-menu__item">
                        <a href="#" class="header-menu__link">Поваренные книги</a>
                        <ul>
                            <li><a href="#">Монографии</a></li>
                            <li><a href="#">Диссертации</a></li>
                            <li><a href="#">Учебники и учебные пособия</a></li>
                        </ul>
                    </li>
                    <li class="header-menu__item"><a href="#" class="header-menu__link">Еда с доставкой</a></li>
                    <li class="header-menu__item"><a href="{{ route('login') }}" class="header-menu__link">Праздничное меню</a></li>
                </ul>
            </div>


            <style>

                .header-menu-burger__wrap {
                    display: flex;
                    justify-content: space-between;
                }

                .header-menu-second .header-menu__item {
                    position: relative;
                }
                .header-menu-second .header-menu__item ul {
                    display: none;
                    width: 400px;
                    background: #f3f6fd;
                    padding: 10px;
                    font-size: 15px;
                    position: absolute;
                    left: 0;
                    top: 100%;
                    border-bottom-left-radius: 4px;
                    border-bottom-right-radius: 4px;
                }

                .header-menu-second .header-menu__item ul li {
                    line-height: 1.3;
                }

                .header-menu-second .header-menu__item ul a:hover {
                    color: #498aed;
                }

                .header-menu-second .header-menu__item ul li:not(:last-child) {
                    margin-bottom: 10px;
                }

                .header-menu-second .header-menu__item:hover ul{
                    display: block;
                }



            </style>

        </div>
        
    </div>

</header>
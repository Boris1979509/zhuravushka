<header>
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <nav>
                    <ul class="header__nav">
                        @foreach($pages as $key => $value)
                            <li class="header__nav-item">
                                <a href="{{ $value['alias'] }}" class="link header__link" title="{{ $value['title'] }}">
                                    {{ $value['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <div class="top-bar__phone">
                    <span>8 800 222 22 22 (с 9:00 до 17:00)</span>
                </div>
                <div class="top-bar__right">
                    <div class="top-bar__user-login">
                        <ul>
                            <li><a class="link" href="/login">Войти</a></li>
                            <li><a class="link" href="/register">Регистрация</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-header">
        <div class="container">
            <div class="row">
                <a href="/" class="sub-header__logo" title="">
                    <img src="{{ asset('images/logo/logo.svg') }}" alt="logo" id="sub-header__logo-img"
                         class="sub-header__logo-img"><span>|</span>Строим вместе
                </a>
                <div class="b-head__search">
                    <div class="b-search">
                        <div class="b-search__input">
                            <input type="text" class="b-input b-input_search" placeholder="Поиск по сайту">
                            <button class="b-search__icon loupe"></button>
                        </div>
                    </div>
                </div>
                <div class="sub-header__right">
                    <a href="" rel="nofollow" class="favorite">
                        <span class="favorite__icon"></span>
                        <span class="sub-header__label">
                        Избранное
                    </span>
                        <span id="favorite-qty" class="favorite__qty">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

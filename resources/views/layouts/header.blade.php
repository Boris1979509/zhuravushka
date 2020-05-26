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
                    <img src="{{ asset('build/images/logo/logo.svg') }}" alt="logo" id="sub-header__logo-img"
                         class="sub-header__logo-img"><span>|</span>Строим вместе
                </a>
            </div>
        </div>
    </div>
</header>

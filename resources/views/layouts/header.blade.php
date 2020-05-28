<header>
    <!-- Start top-bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row top-bar__row">
                <!---->
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
                <!---->
                <div class="top-bar__phone">
                    <span class="top-bar__icon-phone">8 800 222 22 22 (с 9:00 до 17:00)</span>
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
    <!-- End top-bar -->
    <!-- Start sub-header -->
    <div class="sub-header">
        <div class="container">
            <div class="row sub-header__row">

                <!--logo-container-->
                <div class="sub-header__logo-container">
                    <a href="/"  id="sub-header__logo-img" title="Строим вместе"></a>
                    <button class="btn btn-active catalog-spoiler-btn"></button>
                </div>
                <!--end logo-container-->

                <!-- Start search header -->
                <form method="get" class="b-search">
                    <div class="b-search__content">
                        <input type="search" name="search" class="input b-search__input" placeholder="Найдется все! И не только">
                        <span class="b-search__icon loupe"></span>
                    </div>
                </form>
                <div class="sub-header__right">
                    <a href="" rel="nofollow" class="link compare">
                        <span class="icon compare__icon"></span>
                        <span class="sub-header__label">Сравнение</span>
                        {{--<span id="compare-qty" class="qty compare__qty">[1]</span>--}}
                    </a>
                    <a href="" rel="nofollow" class="link favorite">
                        <span class="icon favorite__icon"></span>
                        <span class="sub-header__label">Избранное</span>
                        {{--<span id="favorite-qty" class="qty favorite__qty">[20]</span>--}}
                    </a>
                    <a href="" rel="nofollow" class="link cart">
                        <span class="icon cart__icon"></span>
                        <span class="sub-header__label">Корзина</span>
                        {{--<span id="cart-qty" class="qty cart__qty">[55]</span>--}}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End sub-header -->
</header>

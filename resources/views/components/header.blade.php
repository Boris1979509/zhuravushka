<header>
    <div class="top-bar"><!-- Start top-bar -->
        <div class="container">
            <div class="row top-bar__row">
                <!---->
                <nav>
                    <ul class="top-bar__nav">
                        @php /** @var Page $pageItem  */use App\Models\Shop\Page;@endphp
                        @foreach($pages as $key => $pageItem)
                            @if($key <= 2)
                                <li class="top-bar__nav-item">
                                    <a href="{{ url('page', $pageItem->slug) }}" class="link top-bar__nav-link"
                                       title="{{ $pageItem->title }}">
                                        {{ $pageItem->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <li class="top-bar__nav-item">
                            <a href="{{ route('blog') }}" class="link top-bar__nav-link" title="Советы">Советы</a>
                        </li>
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
    </div><!-- End top-bar -->

    <!-- Start sub-header -->
    <div class="sub-header">
        <div class="container">
            <div class="row sub-header__row">

                <!--logo-container-->
                <div class="sub-header__logo-container row">
                    <a href="{{ route('home') }}" class="sub-header__logo-img" title="Строим вместе"></a>
                    <button class="btn btn-active catalog-spoiler-btn"></button>
                </div>
                <!--end logo-container-->

                <!-- Start search header -->
                <form method="get" class="b-search">
                    <div class="b-search__content">
                        <input type="search" name="search" class="input b-search__input"
                               placeholder="Найдется все! И не только">
                        <span class="b-search__icon loupe"></span>
                    </div>
                </form>
                <div class="sub-header__right">
                    <a href="" rel="nofollow" class="link compare">
                        <div class="icon compare__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.4167 24C15.7388 24 16 23.7761 16 23.5V4.5C16 4.22388 15.7388 4 15.4167 4H9.58333C9.26119 4 9 4.22388 9 4.5V23.5C9 23.7761 9.26119 24 9.58333 24H15.4167ZM10.1667 5H14.8333V23H10.1667V5Z"
                                    fill="white"/>
                                <path
                                    d="M1.5 24H6.5C6.77612 24 7 23.7761 7 23.5V8.5C7 8.22388 6.77612 8 6.5 8H1.5C1.22388 8 1 8.22388 1 8.5V23.5C1 23.7761 1.22388 24 1.5 24ZM2 9H6V23H2V9Z"
                                    fill="white"/>
                                <path
                                    d="M23.5 24C23.7761 24 24 23.7761 24 23.5V0.5C24 0.223877 23.7761 0 23.5 0H18.5C18.2239 0 18 0.223877 18 0.5V23.5C18 23.7761 18.2239 24 18.5 24H23.5ZM19 1H23V23H19V1Z"
                                    fill="white"/>
                            </svg>
                            <span id="compare-qty" class="badge compare__qty">0</span>
                        </div>
                        <span class="sub-header__label">Сравнение</span>
                    </a>
                    <a href="" rel="nofollow" class="link favorite">
                        <div class="icon favorite__icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                    <path
                                        d="M23.6354 5.57473C23.2524 4.48205 22.5798 3.49634 21.6902 2.72417C20.7997 1.95129 19.7287 1.42436 18.593 1.20041C18.165 1.11602 17.7251 1.07324 17.2852 1.07324C16.002 1.07324 14.754 1.4361 13.6761 2.12261C13.0273 2.53589 12.4573 3.05424 11.9877 3.65362C11.5183 3.05539 10.9487 2.53802 10.3005 2.12555C9.22318 1.44004 7.97601 1.0777 6.69378 1.0777C6.6937 1.0777 6.6938 1.0777 6.69375 1.0777C5.62535 1.0777 4.55305 1.34159 3.59308 1.84078C2.63381 2.3396 1.80185 3.06536 1.18724 3.93961C0.557478 4.83535 0.173869 5.83836 0.0470446 6.92075C-0.0640002 7.86868 0.0217581 8.88626 0.301992 9.94524C0.857117 12.043 2.08584 13.9565 3.01886 15.1922C5.04754 17.8792 7.83691 20.3181 11.5464 22.6484L11.9895 22.9267L12.4326 22.6484C16.9954 19.782 20.1802 16.7558 22.1689 13.3967C23.3126 11.4648 23.9084 9.74373 23.9904 8.13517C24.0361 7.23869 23.9167 6.37724 23.6354 5.57473ZM11.9895 20.9556C8.67553 18.8216 6.17273 16.6043 4.34858 14.1883C3.50553 13.0717 2.39861 11.3552 1.9127 9.51902C1.68618 8.66297 1.61524 7.85405 1.70189 7.11464C1.79612 6.31037 2.08152 5.56457 2.55023 4.8979C3.01195 4.24116 3.63838 3.6952 4.36174 3.31906C5.08537 2.94278 5.89176 2.74389 6.69378 2.74389C7.65861 2.74389 8.59648 3.01619 9.40599 3.5313C10.1951 4.03341 10.8294 4.7417 11.2404 5.57961L11.9892 7.10592L12.7366 5.57897C13.1473 4.74006 13.7816 4.03083 14.5712 3.528C15.3812 3.01212 16.3196 2.73946 17.2852 2.73946C17.6171 2.73946 17.9486 2.77165 18.2706 2.83514C19.1218 3.00298 19.9266 3.39972 20.598 3.98249C21.2691 4.56501 21.7757 5.30619 22.063 6.12587C22.2724 6.72336 22.3611 7.37086 22.3264 8.05034C22.2585 9.38276 21.7379 10.8539 20.7351 12.5478C18.9486 15.5654 16.0847 18.3194 11.9895 20.9556Z"
                                        fill="white"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span id="favorite-qty" class="badge favorite__qty">0</span>
                        </div>
                        <span class="sub-header__label">Избранное</span>
                    </a>
                    <a href="{{ route('cart') }}" rel="nofollow" class="link cart">
                        <div class="icon cart__icon {{ ($cartCount) ? 'active' : '' }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.8615 5.01415C23.7241 4.81725 23.503 4.69555 23.2629 4.68529L8.37549 4.04358C7.94834 4.02489 7.59139 4.35466 7.57313 4.77982C7.55498 5.20482 7.88421 5.56392 8.30932 5.58218L22.1888 6.18049L19.4598 14.6952H7.31543L5.12137 2.74865C5.07314 2.48682 4.89338 2.26839 4.64546 2.17112L1.05195 0.759382C0.655903 0.604325 0.208991 0.798858 0.0534498 1.19442C-0.101823 1.59021 0.0926573 2.03739 0.488492 2.19293L3.68369 3.44816L5.91648 15.6044C5.98378 15.9698 6.30227 16.2352 6.67399 16.2352H7.04437L6.19861 18.5845C6.12782 18.7813 6.15699 18.9998 6.27746 19.1708C6.39776 19.3418 6.59343 19.4435 6.8023 19.4435H7.39551C7.02793 19.8526 6.8023 20.3912 6.8023 20.9836C6.8023 22.2575 7.83883 23.2937 9.11243 23.2937C10.386 23.2937 11.4226 22.2575 11.4226 20.9836C11.4226 20.3913 11.1969 19.8526 10.8294 19.4435H15.8661C15.4983 19.8526 15.2727 20.3912 15.2727 20.9836C15.2727 22.2575 16.309 23.2937 17.5829 23.2937C18.8568 23.2937 19.893 22.2575 19.893 20.9836C19.893 20.3913 19.6674 19.8526 19.2999 19.4435H20.0214C20.3758 19.4435 20.6631 19.1562 20.6631 18.8018C20.6631 18.4473 20.3758 18.1601 20.0214 18.1601H7.71535L8.4083 16.235H20.0213C20.3562 16.235 20.6525 16.0187 20.7545 15.7001L23.963 5.68943C24.0367 5.46096 23.9989 5.21116 23.8615 5.01415ZM9.11248 22.0106C8.54623 22.0106 8.08573 21.5501 8.08573 20.9839C8.08573 20.4176 8.54623 19.9571 9.11248 19.9571C9.67874 19.9571 10.1392 20.4176 10.1392 20.9839C10.1392 21.5501 9.67874 22.0106 9.11248 22.0106ZM17.5829 22.0106C17.0166 22.0106 16.5562 21.5501 16.5562 20.9839C16.5562 20.4176 17.0166 19.9571 17.5829 19.9571C18.1491 19.9571 18.6096 20.4176 18.6096 20.9839C18.6096 21.5501 18.1491 22.0106 17.5829 22.0106Z"
                                    fill="white"/>
                            </svg>
                            <span id="cart-qty" class="badge cart__qty">{{ $cartCount }}</span>
                        </div>
                        <span class="sub-header__label cart-total-sum">
                            @if($cartCount)
                                {{ $order->getTotalSum() }} <span class="rub">₽</span>
                            @else
                                Корзина
                            @endif
                        </span>
                    </a>
                </div>

            </div>
            <div id="catalogMenu" hidden>
                @include('components.barMenu')
            </div>
        </div>
    </div>

    <!-- End sub-header -->
</header>

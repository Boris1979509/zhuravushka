<footer>
    <div class="footer">
        <div class="footer__footer-top">
            <div class="container">
                <div class="row footer-top__row">
                    <div class="footer__company">
                        <p class="footer__title">О компании</p>
                        <ul class="footer__nav">
                            @foreach($pages as $key => $value)
                                <li class="footer__nav-item">
                                    <a href="{{ $value['alias'] }}" class="link footer__link"
                                       title="{{ $value['title'] }}">
                                        {{ $value['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="footer__catalog">
                        <p class="footer__title">Товары компании</p>
                        <ul class="footer__nav footer_columns">
                            <li>
                                <a class="link footer__link" href="" title=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer__logo-wrap">
                <div class="container">
                    <div class="row logo-wrap__row">
                        <a href="/" class="footer__logo" title="">
                            <img src="{{ asset('images/logo/logo-footer.svg') }}" alt="" class="footer__logo-img">
                        </a>
                        <a href="https://webstyle.top/" class="webstyle__link footer__text" target="_blank"
                           rel="noopener" title="Создание сайтов Белгород">
                            <img src="{{ asset('images/logo/webstyle-logo.svg') }}" alt="" class="webstyle__img">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <p>2007 - 2020 ООО «Журавушка»<br>Продолжая работу с сайтом, вы даете согласие на использование сайтом cookies
                и обработку персональных данных в целях функционирования сайта, проведения ретаргетинга, статистических
                исследований, улучшения сервиса и предоставления релевантной рекламной информации на основе ваших
                предпочтений и интересов.</p>
        </div>
    </div>
</footer>

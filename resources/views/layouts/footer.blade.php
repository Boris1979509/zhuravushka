<footer>
    <div class="footer">
        <div class="footer-top">
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
        </div>
    </div>
</footer>

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
                            @php /** @var ShopCategory $categoryItem */use App\Models\Shop\ShopCategory;@endphp
                            @foreach($shopCategory as $categoryItem)
                                <li class="footer__nav-item">
                                    <a class="link footer__link" href="" title="">{{ $categoryItem->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="footer__pay">
                        <p class="footer__title">Мы принимаем к оплате</p>
                        <div class="pay">
                            <img src="{{ asset('images/pay/all-pay.png') }}" alt="all-pay" class="pay__icon">
                        </div>
                    </div>
                    <div class="footer__contacts">
                        <p class="footer__title">Мы в социальных сетях</p>
                        <div class="row footer__social">
                            <a class="footer__social-link  footer__social-link--facebook" href="" target="_blank"
                               rel="nofollow">
                                <svg width="41" height="41" viewBox="0 0 41 41" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="20.0848" cy="20.0848" r="20.0848" fill="#D7ECFF"/>
                                    <path
                                        d="M29 8H11C9.3455 8 8 9.3455 8 11V29C8 30.6545 9.3455 32 11 32H29C30.6545 32 32 30.6545 32 29V11C32 9.3455 30.6545 8 29 8Z"
                                        fill="#1976D2"/>
                                    <path
                                        d="M28.25 20H24.5V17C24.5 16.172 25.172 16.25 26 16.25H27.5V12.5H24.5C22.0145 12.5 20 14.5145 20 17V20H17V23.75H20V32H24.5V23.75H26.75L28.25 20Z"
                                        fill="#FAFAFA"/>
                                </svg>
                            </a>
                            <a class="footer__social-link  footer__social-link--instagram" href="" target="_blank"
                               rel="nofollow">
                                <svg width="41" height="41" viewBox="0 0 41 41" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="20.0848" cy="20.0848" r="20.0848" fill="#D7ECFF"/>
                                    <path
                                        d="M24.5 8H15.5C11.3585 8 8 11.3585 8 15.5V24.5C8 28.6415 11.3585 32 15.5 32H24.5C28.6415 32 32 28.6415 32 24.5V15.5C32 11.3585 28.6415 8 24.5 8ZM29.75 24.5C29.75 27.395 27.395 29.75 24.5 29.75H15.5C12.605 29.75 10.25 27.395 10.25 24.5V15.5C10.25 12.605 12.605 10.25 15.5 10.25H24.5C27.395 10.25 29.75 12.605 29.75 15.5V24.5Z"
                                        fill="url(#paint0_linear)"/>
                                    <path
                                        d="M20 14C16.6865 14 14 16.6865 14 20C14 23.3135 16.6865 26 20 26C23.3135 26 26 23.3135 26 20C26 16.6865 23.3135 14 20 14ZM20 23.75C17.933 23.75 16.25 22.067 16.25 20C16.25 17.9315 17.933 16.25 20 16.25C22.067 16.25 23.75 17.9315 23.75 20C23.75 22.067 22.067 23.75 20 23.75Z"
                                        fill="url(#paint1_linear)"/>
                                    <path
                                        d="M26.4501 14.3495C26.8917 14.3495 27.2496 13.9915 27.2496 13.55C27.2496 13.1084 26.8917 12.7505 26.4501 12.7505C26.0086 12.7505 25.6506 13.1084 25.6506 13.55C25.6506 13.9915 26.0086 14.3495 26.4501 14.3495Z"
                                        fill="url(#paint2_linear)"/>
                                    <defs>
                                        <linearGradient id="paint0_linear" x1="10.197" y1="29.8032" x2="29.803"
                                                        y2="10.1968"
                                                        gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFC107"/>
                                            <stop offset="0.507" stop-color="#F44336"/>
                                            <stop offset="0.99" stop-color="#9C27B0"/>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear" x1="15.7575" y1="24.2425" x2="24.2425"
                                                        y2="15.7575" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFC107"/>
                                            <stop offset="0.507" stop-color="#F44336"/>
                                            <stop offset="0.99" stop-color="#9C27B0"/>
                                        </linearGradient>
                                        <linearGradient id="paint2_linear" x1="25.8849" y1="14.1154" x2="27.0154"
                                                        y2="12.9847" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#FFC107"/>
                                            <stop offset="0.507" stop-color="#F44336"/>
                                            <stop offset="0.99" stop-color="#9C27B0"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </a>
                            <a class="footer__social-link  footer__social-link--ok" href="" target="_blank"
                               rel="nofollow">
                                <svg width="41" height="41" viewBox="0 0 41 41" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="20.0848" cy="20.0848" r="20.0848" fill="#D7ECFF"/>
                                    <path
                                        d="M20.0002 20.9878C23.5867 20.9878 26.4942 18.0804 26.4942 14.4939C26.4942 10.9074 23.5868 8 20.0002 8C16.4137 8 13.5063 10.9074 13.5063 14.4939C13.5107 18.0786 16.4156 20.9834 20.0002 20.9878ZM20.0002 10.9972C21.9314 10.9972 23.497 12.5627 23.497 14.4939C23.497 16.4252 21.9315 17.9907 20.0002 17.9907C18.069 17.9907 16.5035 16.4252 16.5035 14.4939C16.5035 12.5627 18.0691 10.9972 20.0002 10.9972Z"
                                        fill="#FF9800"/>
                                    <path
                                        d="M26.3612 24.0649C27.067 23.6 27.4922 22.8119 27.4932 21.9668C27.503 21.2655 27.1073 20.6215 26.4772 20.3134C25.8298 19.99 25.0548 20.0628 24.479 20.5012C21.8104 22.4467 18.191 22.4467 15.5224 20.5012C14.9457 20.0651 14.1721 19.9924 13.5243 20.3134C12.8944 20.6214 12.4985 21.2647 12.5072 21.9658C12.5087 22.8107 12.9338 23.5986 13.6392 24.0638C14.5441 24.6657 15.5297 25.1366 16.5665 25.4626C16.7423 25.5172 16.9238 25.5678 17.111 25.6144L14.0918 28.5667C13.2998 29.3351 13.2806 30.6001 14.0491 31.3921C14.8175 32.1841 16.0825 32.2033 16.8746 31.4348C16.891 31.4188 16.9072 31.4026 16.9232 31.386L20.0003 28.201L23.0834 31.392C23.8512 32.1846 25.1162 32.2048 25.9089 31.437C26.7015 30.6692 26.7216 29.4042 25.9538 28.6115C25.9377 28.595 25.9214 28.5787 25.9048 28.5626L22.8906 25.6134C23.0777 25.5654 23.2599 25.5145 23.4371 25.4605C24.4727 25.1358 25.4573 24.6659 26.3612 24.0649Z"
                                        fill="#FF9800"/>
                                </svg>
                            </a>
                            <a class="footer__social-link  footer__social-link--vk" href="" target="_blank"
                               rel="nofollow">
                                <svg width="41" height="41" viewBox="0 0 41 41" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="20.0848" cy="20.0848" r="20.0848" fill="#D7ECFF"/>
                                    <g clip-path="url(#clip0)">
                                        <path
                                            d="M19.7429 26.7892H21.1771C21.1771 26.7892 21.6106 26.7412 21.8311 26.5027C22.0351 26.2837 22.0276 25.8726 22.0276 25.8726C22.0276 25.8726 21.9991 23.948 22.8932 23.6645C23.7737 23.3855 24.9048 25.5246 26.1034 26.3482C27.0095 26.9707 27.698 26.8342 27.698 26.8342L30.9038 26.7892C30.9038 26.7892 32.5809 26.6857 31.7858 25.3671C31.7213 25.2591 31.3223 24.392 29.4022 22.6099C27.392 20.7438 27.662 21.0468 30.0832 17.82C31.5578 15.8549 32.1474 14.6548 31.9628 14.1418C31.7873 13.6527 30.7027 13.7817 30.7027 13.7817L27.0965 13.8028C27.0965 13.8028 26.8295 13.7667 26.63 13.8853C26.4364 14.0023 26.3119 14.2723 26.3119 14.2723C26.3119 14.2723 25.7404 15.7934 24.9783 17.0865C23.3717 19.8152 22.7282 19.9592 22.4656 19.7897C21.8551 19.3952 22.0081 18.2026 22.0081 17.3565C22.0081 14.7118 22.4086 13.6092 21.2266 13.3242C20.8335 13.2297 20.5455 13.1667 19.5419 13.1562C18.2548 13.1427 17.1643 13.1607 16.5477 13.4622C16.1367 13.6632 15.8202 14.1118 16.0137 14.1373C16.2522 14.1688 16.7922 14.2828 17.0788 14.6728C17.4493 15.1754 17.4358 16.3064 17.4358 16.3064C17.4358 16.3064 17.6488 19.4192 16.9392 19.8062C16.4517 20.0717 15.7842 19.5302 14.3516 17.0535C13.618 15.7859 13.063 14.3833 13.063 14.3833C13.063 14.3833 12.9565 14.1223 12.7659 13.9828C12.5349 13.8133 12.2109 13.7592 12.2109 13.7592L8.78165 13.7802C8.78165 13.7802 8.26711 13.7953 8.0781 14.0188C7.91008 14.2183 8.0646 14.6293 8.0646 14.6293C8.0646 14.6293 10.7498 20.9103 13.789 24.077C16.5777 26.9797 19.7429 26.7892 19.7429 26.7892Z"
                                            fill="#1E88E5"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect x="8" y="8" width="24" height="24" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>
                        <div class="footer__phone">
                            <div id="footer-online-phone">+7 (4722) 400 999</div>
                            <span>Многоканальная линия</span>
                        </div>
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
                            <img src="{{ asset('images/logo/webstyle-logo.svg') }}" alt="webstyle-logo"
                                 class="webstyle__img">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <p>2007 - 2020 ООО «Журавушка»<br>Продолжая работу с сайтом, вы даете согласие на использование сайтом
                cookies
                и обработку персональных данных в целях функционирования сайта, проведения ретаргетинга, статистических
                исследований, улучшения сервиса и предоставления релевантной рекламной информации на основе ваших
                предпочтений и интересов.</p>
        </div>
    </div>
</footer>

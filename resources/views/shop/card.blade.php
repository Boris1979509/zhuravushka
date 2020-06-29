<div class="glider-contain">
    <div class="glider" id="glider-leader-sales">
        @php /** @var Product $productItem */use App\Models\Shop\Product;@endphp
        @foreach($products as $productItem)
            <div class="card">
                <div>
                    <div class="card__icons">
                        <div class="favorite">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="11.5" stroke="#D4D4D4"/>
                                <path
                                    d="M14.8125 6.70312C14.1613 6.70312 13.5643 6.90947 13.0381 7.31644C12.5336 7.7066 12.1977 8.20355 12 8.56491C11.8023 8.20352 11.4664 7.7066 10.9619 7.31644C10.4357 6.90947 9.83866 6.70312 9.1875 6.70312C7.37034 6.70312 6 8.18946 6 10.1605C6 12.2899 7.7096 13.7468 10.2977 15.9523C10.7372 16.3269 11.2354 16.7514 11.7532 17.2042C11.8214 17.264 11.9091 17.2969 12 17.2969C12.0909 17.2969 12.1786 17.264 12.2468 17.2042C12.7647 16.7514 13.2628 16.3268 13.7026 15.9521C16.2904 13.7468 18 12.2899 18 10.1605C18 8.18946 16.6297 6.70312 14.8125 6.70312Z"
                                    fill="#E6E4E4" class="favorite-icon-bg"/>
                            </svg>
                        </div>
                        <div class="compare">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="11.5" stroke="#D5D5D5"/>
                                <rect x="15" y="6" width="3" height="12" rx="0.5" fill="#E6E4E4"/>
                                <rect x="10.5" y="8" width="3" height="10" rx="0.5" fill="#E6E4E4"/>
                                <rect x="6" y="10" width="3" height="8" rx="0.5" fill="#E6E4E4"/>
                                <line x1="6" y1="17.3" x2="18" y2="17.3" stroke="#E6E4E4"
                                      stroke-width="1.4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="card__body">
                        <a href="{{ route('product', $productItem->slug) }}" title="{{ $productItem->title }}">
                            <img src="{{ asset("images/products/{$productItem->photo}.jpg") }}" class="card__img-top"
                                 alt="{{ $productItem->title }}">
                        </a>
                    </div>
                    <div class="card__title">
                        <a href="{{ route('product', $productItem->slug) }}"
                           class="link card__link">{{ $productItem->title }}</a>
                    </div>
                    <div class="card__footer">
                        <div class="price">
                            <div class="price__item">
                                <p class="price__title-old">Старая цена</p>
                                <span class="price__old">282</span>
                                <span class="rub">₽</span>
                            </div>
                            <div class="price__item">
                                <p class="price__title-new">Новая цена</p>
                                <span class="bold price__new">{{ numberFormat($productItem->price) }}&nbsp;₽</span>
                                <span class="last-text-new">за шт.</span>
                            </div>
                        </div>
                        <form action="{{ route('cart.add', $productItem) }}" method="POST" class="addCart">
                            @csrf
                            <div class="product-qty">
                                <div class="product-qty__qty">
                                    <span class="product-qty__minus"></span>
                                    <input type="text" class="product-qty__input" value="1" name="qty">
                                    <span class="product-qty__plus"></span>
                                </div>
                                <button class="btn btn-active btn-add">В корзину</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button aria-label="Previous" class="glider-prev" id="glider-prev-leaders-sales"></button>
    <button aria-label="Next" class="glider-next" id="glider-next-leaders-sales"></button>
    <div role="tablist" class="dots"></div>
</div>

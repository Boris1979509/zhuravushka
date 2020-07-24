@extends('layouts.app')
@php /** @var Product $product */use App\Models\Shop\Product;@endphp
@section('title', $product->title)
@section('description', $product->description)

@section('content')
    <div class="container">
        <div class="product-wrap">
            <div class="product">
                <div class="product__photo-container">
                    <img src="{{ fileExist("images/products/{$product->photo}.jpg") }}" alt="{{ $product->title }}"
                         class="product__img">
                </div>
                <div class="product__all">
                    <h1>{{ $product->title }}</h1>
                    <div class="product__desc">
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="characteristics">
                        <div class="characteristics__props">
                            <p class="characteristics__props-name">Код товара</p>
                            <p class="characteristics__props-value">{{ $product->code }}</p>
                        </div>
                        <div class="characteristics__props">
                            <p class="characteristics__props-name">Бренд</p>
                            <p class="characteristics__props-value">Ariston</p>
                        </div>
                        <div class="characteristics__props">
                            <p class="characteristics__props-name">Расположение</p>
                            <p class="characteristics__props-value">вертикальное</p>
                        </div>
                        <div class="characteristics__props">
                            <p class="characteristics__props-name">Мощность</p>
                            <p class="characteristics__props-value">1500 Вт</p>
                        </div>
                        <div class="characteristics__props">
                            <p class="characteristics__props-name">Объем бака</p>
                            <p class="characteristics__props-value">50 л</p>
                        </div>
                        <div class="characteristics__props">
                            <p class="characteristics__props-name">Вес</p>
                            <p class="characteristics__props-value">17 кг</p>
                        </div>
                    </div>
                </div>
                <div class="product__actions-container">
                    <div class="card">
                        <div>
                            <div class="card__footer">
                                @include('shop.priceBlock', ['product' => $product])
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="addCart">
                                    @csrf
                                    <div class="product-qty">
                                        <div class="product-qty__qty">
                                            <span class="product-qty__minus"></span>
                                            <input type="text" class="product-qty__input" value="1" name="qty">
                                            <span class="product-qty__plus"></span>
                                        </div>
                                        <button class="btn btn-active btn-add">{{ __('CartButtonAdd') }}</button>
                                    </div>
                                </form>
                                <div class="card__icons">
                                    <div class="favorite">
                                        <div>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="11.5" stroke="#D4D4D4"/>
                                                <path
                                                    d="M14.8125 6.70312C14.1613 6.70312 13.5643 6.90947 13.0381 7.31644C12.5336 7.7066 12.1977 8.20355 12 8.56491C11.8023 8.20352 11.4664 7.7066 10.9619 7.31644C10.4357 6.90947 9.83866 6.70312 9.1875 6.70312C7.37034 6.70312 6 8.18946 6 10.1605C6 12.2899 7.7096 13.7468 10.2977 15.9523C10.7372 16.3269 11.2354 16.7514 11.7532 17.2042C11.8214 17.264 11.9091 17.2969 12 17.2969C12.0909 17.2969 12.1786 17.264 12.2468 17.2042C12.7647 16.7514 13.2628 16.3268 13.7026 15.9521C16.2904 13.7468 18 12.2899 18 10.1605C18 8.18946 16.6297 6.70312 14.8125 6.70312Z"
                                                    fill="#E6E4E4" class="favorite-icon-bg"/>
                                            </svg>
                                        </div>
                                        <div class="favorite__title">В избранное</div>
                                    </div>
                                    <div class="compare">
                                        <div>
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
                                        <div class="compare__title">В сравнение</div>
                                    </div>
                                    <div class="informer">
                                        <div>
                                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12.4836" r="11.5" stroke="#FC8507"/>
                                                <path
                                                    d="M9.26 18V16.502H8.14V15.144H9.26V14.052H8.14V12.316H9.26V8.004H12.452C13.74 8.004 14.678 8.26533 15.266 8.788C15.8633 9.31067 16.162 10.0293 16.162 10.944C16.162 11.4853 16.0407 11.994 15.798 12.47C15.5553 12.946 15.1493 13.3287 14.58 13.618C14.02 13.9073 13.2547 14.052 12.284 14.052H11.374V15.144H13.53V16.502H11.374V18H9.26ZM11.374 12.316H12.074C12.6713 12.316 13.1427 12.2133 13.488 12.008C13.8427 11.8027 14.02 11.4713 14.02 11.014C14.02 10.1647 13.46 9.74 12.34 9.74H11.374V12.316Z"
                                                    fill="#FC8507"/>
                                            </svg>
                                        </div>
                                        <div class="informer__title">Сообщить об изменении цены?</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-info-tabs">
                @include('shop.productTabs')
            </div>
            <div class="more-goods">
                @include('shop.moreGoods')
            </div>
        </div>
    </div>
@endsection

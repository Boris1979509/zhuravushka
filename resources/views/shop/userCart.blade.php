@extends('layouts.app')
@section('title', $page['title'])
@section('content')
    <section id="cart">
        <div class="container">
            <h1 class="title">Корзина</h1>
            <div class="cart-wrap">
                @if($order->count())
                    <div class="cart">
                        @foreach ($order->products as $item)
                            <div class="cart__product">
                                <div class="cart__img">
                                    <a href="" target="_blank">
                                        <img src="{{ asset($item->photo) }}" alt="" class="cart__image">
                                    </a>
                                </div>
                                <div class="cart__name">
                                    <a href="" target="_blank" class="link cart__name-link">
                                        {{ $item->title }}
                                    </a>
                                </div>
                                <div class="cart__count">
                                    <div class="count">
                                <span class="count__minus">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.5 5.75C7.72744 5.75 6.49326 5.75 5.5 5.75H0V8.25H5.5C7.0559 8.25 7.67852 8.25 8.5 8.25H14V5.75H8.5Z"
                                            fill="#7B7B7B"/>
                                    </svg>
                                </span>
                                        <input type="text" class="count__input" value="1">
                                        <span class="count__plus">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.5 5.75C8.36194 5.75 8.25 5.63806 8.25 5.5V0H5.75V5.5C5.75 5.63806 5.63806 5.75 5.5 5.75H0V8.25H5.5C5.63806 8.25 5.75 8.36194 5.75 8.5V14H8.25V8.5C8.25 8.36194 8.36194 8.25 8.5 8.25H14V5.75H8.5Z"
                                            fill="#7B7B7B"/>
                                    </svg>
                                </span>
                                    </div>
                                    <div class="qty-goods">
                                        <p class="qty-goods__balance">1 шт. в наличии</p>
                                        <p class="qty-goods__order">+25 шт. под заказ</p>
                                    </div>

                                </div>
                                <div class="cart__sum">
                                    <p class="cart__sum-price">{{ $item->price }} <span class="rub">₽</span></p>
                                    <p class="order">+25 шт. x 35 ₽</p>
                                </div>
                                <div title="Убрать из корзины" class="cart__del">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0)">
                                            <path
                                                d="M16 1.8854L14.1146 0L7.99998 6.11457L1.8854 0L0 1.8854L6.11457 7.99998L0 14.1146L1.8854 16L7.99998 9.88542L14.1146 16L16 14.1146L9.88542 7.99998L16 1.8854Z"
                                                fill="#CECECE"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0">
                                                <rect width="16" height="16" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="cart-total-wrap">
                        <div class="checkout-wrap">
                            <div class="cart-sale">
                                <p class="cart-total-wrap__title">Скидка:</p>
                                <p class="cart-total-wrap__total-price">1 000<span class="rub"></span></p>
                            </div>
                            <div class="cart-total">
                                <p class="cart-total-wrap__title">Итого:</p>
                                <p class="cart-total-wrap__total-price">1 500<span class="rub">₽</span></p>
                            </div>
                            <div class="cart-checkout">
                                <button class="btn btn-active cart-checkout__btn">Оформить заказ</button>
                            </div>
                        </div>
                    </div>
                    <div class="primary-info">
                        <p>В Вашей корзине есть товар с пометкой "Под заказ", в связи с этим срок доставки может
                            измениться.</p>
                    </div>
                @else
                    <p>Ваша корзина пуста.</p>
                @endif
            </div>
        </div>

    </section>
@endsection

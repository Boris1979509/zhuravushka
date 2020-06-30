@extends('layouts.app')
@section('description', '')
@section('title', __('Order Place'))
@section('content')
    <div class="container">
        <div class="order-registration">
            <div class="order-registration__select-delivery">
                <div class="title">Выберите доставку</div>
                <div class="delivery-type">
                    <div class="delivery-type__saving">
                        <div class="icon-title"></div>
                        <p class="title">Эконом</p>
                        <div class="description">
                            Самая низкая цена на доставку. Для тех кто не привязан ко времени выгрузки.
                        </div>
                        <div class="price">от 3 384 <span class="rub">₽</span></div>
                        <div class="question-block"><span class="question">?</span></div>
                    </div>
                    <div class="delivery-type__express">
                        <div class="icon-title"></div>
                        <p class="title">Экспресс</p>
                        <div class="description">Доставка до 4 часов! Хотите быстро получить свой заказ, тогда этот тип
                            доставки для Вас.
                        </div>
                        <div class="price">Рассчитывается менеджером</div>
                        <div class="question-block"><span class="question">?</span></div>
                    </div>
                </div>
            </div>
            <div class="order-registration__select-address-delivery">
                <div class="delivery-address-block">
                    <div class="delivery-address-block__form">
                        <div class="title">Выберите адрес доставки</div>
                        <form action="#" method="POST" class="form-label form-css-label">
                            @csrf
                            <div class="form-input">
                                <input type="text" class="input" name="city" id="city" autocomplete="off" required >
                                <label for="city">{{ __('City') }}</label>
                            </div>
                            <div class="form-input">
                                <input type="text" class="input" name="street" id="street" autocomplete="off" required >
                                <label for="street">{{ __('Street') }}</label>
                            </div>
                            <div class="form-input">
                                <input type="text" class="input" name="houseNumber" id="houseNumber" autocomplete="off" required >
                                <label for="houseNumber">{{ __('HouseNumber') }}</label>
                            </div>
                            <button type="submit" class="btn btn-active btn-find-place-map">{{ __('Найти адрес на карте') }}</button>
                        </form>
                    </div>
                    <div class="delivery-address-block__map">
                        <img src="{{ asset('images/delivery-map.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="order-registration__select-payment-method">
                <div class="title">Выберите способ оплаты</div>
                <div class="payment-type">
                    <div class="payment-type__cash">
                        <div class="icon-title"></div>
                        <p class="title">Водителю наличными</p>
                        <div class="description">
                            Наши водители примут оплату наличными при доставке Вашего заказа.
                        </div>
                        <div class="question-block"><span class="question">?</span></div>
                    </div>
                    <div class="payment-type__online">
                        <div class="icon-title"></div>
                        <p class="title">Оплата онлайн на сайте</p>
                        <div class="description">Вы можете оплатить товар на нашем сайте при помощи банковской карты
                        </div>
                        <div class="question-block"><span class="question">?</span></div>
                    </div>
                </div>
            </div>
            <div class="order-registration__contact-form">
                <div class="title">Укажите контактную информацию</div>
                <form action="{{ route('cart.confirm') }}" method="POST">
                    @csrf
                    <input type="text" name="lastName" id="lastName" class="input"
                           placeholder="{{ __('LastName') }}">
                    <input type="text" name="firstName" id="firstName" class="input"
                           placeholder="{{ __('FirstName') }}">
                    <input type="text" name="middleName" id="middleName" class="input"
                           placeholder="{{ __('MiddleName') }}">
                    <input type="text" name="phone" id="phone" class="input" placeholder="{{ __('Phone') }}">
                    <input type="email" name="email" id="email" class="input" placeholder="{{ __('Email') }}">
                    <textarea name="orderMessage" id="orderMessage" cols="30" rows="10"
                              placeholder="{{ __('OrderMessage') }}" class="input"></textarea>
                    <button type="submit" class="btn btn-active">{{ __('OrderConfirm') }}</button>
                </form>
            </div>
            <div class="order-registration__info">
                <div class="cart-total-wrap">
                    <div class="checkout-wrap">
                        <div class="cart-item">
                            <p class="cart-total-wrap__title">{{ __('Quantity') }}</p>
                            <p class="cart-total-wrap__item">{{ $order->cartCount() }}</p>
                        </div>
                        <div class="cart-sale">
                            <p class="cart-total-wrap__title">{{ __('Sale') }}</p>
                            <p class="cart-total-wrap__total-price-sale">0 <span class="rub">₽</span></p>
                        </div>
                        <div class="cart-total">
                            <p class="cart-total-wrap__title bold">{{ __('Total') }}</p>
                            <p class="cart-total-wrap__total-price bold">{{ $order->getTotalSum() }} <span
                                    class="rub">₽</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


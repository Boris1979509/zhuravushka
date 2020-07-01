@extends('layouts.app')
@section('description', '')
@section('title', __('Order Place'))
@section('content')
    <div class="container">
        <form action="{{ route('cart.confirm') }}" method="POST" class="form-label">
            @csrf
            <div class="order-registration">
                <div class="order-registration__select-delivery">
                    <div class="title">{{ __('SelectDeliveryTitle') }}</div>
                    <div class="delivery-type">
                        <div class="delivery-type__saving">
                            <div class="icon-title"></div>
                            <p class="title">{{ __('SavingTitle') }}</p>
                            <div class="description">
                                {{ __('SavingTitleDescription') }}
                            </div>
                            <div class="price">от 3 384 <span class="rub">₽</span></div>
                            <div class="question-block"><span class="question">?</span></div>
                        </div>
                        <div class="delivery-type__express">
                            <div class="icon-title"></div>
                            <p class="title">{{ __('ExpressTitle') }}</p>
                            <div class="description">{{ __('ExpressTitleDescription') }}
                            </div>
                            <div class="price">{{ __('CalculatedByManager') }}</div>
                            <div class="question-block"><span class="question">?</span></div>
                        </div>
                    </div>
                </div>
                <div class="order-registration__select-address-delivery">
                    <div class="delivery-address-block">
                        <div class="delivery-address-block__form">
                            <div class="title">{{ __('SelectAddressDeliveryTitle') }}</div>
                            <div class="form-input">
                                <input type="text" class="input" name="city" id="city">
                                <label for="city">{{ __('City') }}</label>
                            </div>
                            <div class="form-input">
                                <input type="text" class="input" name="street" id="street">
                                <label for="street">{{ __('Street') }}</label>
                            </div>
                            <div class="form-input">
                                <input type="text" class="input" name="houseNumber" id="houseNumber">
                                <label for="houseNumber">{{ __('HouseNumber') }}</label>
                            </div>
                            <button type="submit"
                                    class="btn btn-active btn-find-place-map">{{ __('FindAddressOnMapTitle') }}</button>
                        </div>
                        <div class="delivery-address-block__map">
                            <img src="{{ asset('images/delivery-map.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="order-registration__select-payment-method">
                    <div class="title">{{ __('SelectPaymentTitle') }}</div>
                    <div class="payment-type">
                        <div class="payment-type__cash">
                            <div class="icon-title"></div>
                            <p class="title">{{ __('DriverCashTitle') }}</p>
                            <div class="description">
                                {{ __('DriverCashDescription') }}
                            </div>
                            <div class="question-block"><span class="question">?</span></div>
                        </div>
                        <div class="payment-type__online">
                            <div class="icon-title"></div>
                            <p class="title">{{ __('PaymentOnline') }}</p>
                            <div class="description">{{ __('PaymentOnlineDescription') }}
                            </div>
                            <div class="question-block"><span class="question">?</span></div>
                        </div>
                    </div>
                </div>
                <div class="order-registration__contact-form">
                    <div class="title">{{ __('EnterContactInfo') }}</div>
                    <div class="form-input">
                        <input type="text" name="lastName" id="lastName" class="input"
                               placeholder="">
                        <label for="lastName">{{ __('LastName') }}</label>
                    </div>
                    <div class="form-input">
                        <input type="text" name="firstName" id="firstName" class="input"
                               placeholder="">
                        <label for="firstName">{{ __('FirstName') }}</label>
                    </div>
                    <div class="form-input">
                        <input type="text" name="middleName" id="middleName" class="input"
                               placeholder="">
                        <label for="">{{ __('MiddleName') }}</label>
                    </div>
                    <div class="form-input">
                        <input type="text" name="phone" id="phone" class="input mask-input" placeholder=""
                               pattern="(\+7[-_()\s]+|\+7\s?[(]{0,1}[0-9]{3}[)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2})" required autocomplete="off">
                        <label for="phone">{{ __('Phone') }}</label>
                    </div>
                    <div class="form-input">
                        <input type="email" name="email" id="email" class="input" placeholder="">
                        <label for="email">{{ __('Email') }}</label>
                    </div>
                    <div class="form-input">
                    <textarea name="orderMessage" id="orderMessage" cols="30" rows="4"
                              placeholder="{{ __('OrderMessage') }}"></textarea>
                    </div>

                </div>
                <div class="order-registration__info">
                    <div class="order-registration__info-container">
                        <div class="title">{{ __('YourOrderTitle') }}</div>
                        @php /** @var $product Product */use App\Models\Shop\Product;@endphp
                        @foreach($order->products as $product)
                            <div class="cart">
                                <div class="cart__product-title">{{ $product->title }}</div>
                                <div
                                    class="cart__product-item-total-sum">{{ numberFormat($product->getItemTotalSum()) }}
                                    <span
                                        class="rub">₽</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="cart-total-wrap">
                            <div class="cart-delivery">
                                <p class="cart-delivery__title">{{ __('Delivery') }}</p>
                                <p class="cart-delivery__total">0 <span class="rub">₽</span></p>
                            </div>
                            <div class="cart-total">
                                <p class="cart-total__title">{{ __('TotalOrder') }}</p>
                                <p class="cart-total__total-sum">{{ $order->getTotalSum() }} <span
                                        class="rub">₽</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="confirm-order-container">
                        <button type="submit"
                                class="btn btn-active confirm-order-container__btn">{{ __('OrderConfirm') }}</button>
                        <div class="confirm-order-container__primary-info">
                            <p>{{ __('MessageConfirmOrder') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


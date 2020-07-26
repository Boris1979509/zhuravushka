@extends('layouts.app')
@section('description', '')
@section('title', __('Order Place'))
@section('content')
    <div class="container">
        <div class="message"></div>
        <form action="{{ route('order.confirm') }}" method="POST" class="form-label" id="order-form">
            @csrf
            <div class="order-registration">
                <div class="order-registration__select-delivery">
                    <div class="title">{{ __('SelectDeliveryTitle') }}</div>
                    <div class="delivery-type">
                        <div class="delivery-type__saving active">
                            <input type="radio" id="delivery-saving" name="delivery_type" value="saving" checked>
                            <p class="title">{{ __('SavingTitle') }}</p>
                            <div class="description">
                                {{ __('SavingTitleDescription') }}
                            </div>
                            <div class="price">от 3 384 <span class="rub">₽</span></div>
                            <div class="question-block"><span class="question">?</span></div>
                        </div>
                        <div class="delivery-type__express">
                            <input type="radio" id="delivery-express" name="delivery_type" value="express">
                            <p class="title">{{ __('ExpressTitle') }}</p>
                            <div class="description">{{ __('ExpressTitleDescription') }}
                            </div>
                            <div class="price">{{ __('CalculatedByManager') }}</div>
                            <div class="question-block"><span class="question">?</span></div>
                        </div>
                    </div>
                    <div class="date-time-delivery" hidden>
                        <div class="date-delivery">
                            <div class="date-delivery__title">{{ __('DateDeliveryTitle') }}</div>
                            <div class="date-delivery__options">
                                <div class="date-delivery__options-item tomorrow">
                                    <span>{{ __('Tomorrow') . limitMonth(parseDate(carbon())->tomorrow()->format('j F')) }}</span>
                                </div>
                                <div class="date-delivery__options-item day-after-tomorrow">
                                    <span>{{ __('DayAfterTomorrow') . limitMonth(parseDate(carbon())->addDays(2)->format('j F')) }}</span>
                                </div>
                                <div class="delivery-date-other-block">
                                    <input type="text" id="other-date" name="delivery_date" autocomplete="off"
                                           placeholder=" {{ __('SelectDateDelivery') }}" class="delivery-date-other">
                                    <img
                                        src="{{ asset('images/icons/order-registration/order-arrow.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="time-delivery">
                            <div class="time-delivery__title">{{ __('TimeDeliveryTitle') }}</div>
                            <div class="time-delivery__select-block">
                                <select name="delivery_time" class="select">
                                    <option selected>{{ __('SelectTimeDelivery') }}</option>
                                    <option value="с 10:00 до 12:00">с 8:30 до 12:00</option>
                                    <option value="с 12:00 до 16:00">с 12:00 до 17:30</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-registration__select-address-delivery">
                    <div class="delivery-address-block">
                        <div class="delivery-address-block__form">
                            <div class="title">{{ __('SelectAddressDeliveryTitle') }}</div>
                            <div class="form-input">
                                <input type="text" class="input" name="city" id="city">
                                <label for="city">{{ __('City') }}<span class="require">*</span></label>
                            </div>
                            <div class="form-input">
                                <input type="text" class="input" name="street" id="street">
                                <label for="street">{{ __('Street') }}<span class="require">*</span></label>
                            </div>
                            <div class="form-input">
                                <input type="text" class="input" name="house_number" id="houseNumber">
                                <label for="houseNumber">{{ __('HouseNumber') }}<span class="require">*</span></label>
                            </div>
                        <!--<button type="submit"
                                    class="btn btn-active btn-find-place-map">{{-- __('FindAddressOnMapTitle') --}}</button>-->
                        </div>
                    <!--<div class="delivery-address-block__map">
                            <img src="{{-- asset('images/delivery-map.jpg') --}}" alt="">
                        </div>-->
                    </div>
                </div>
                <div class="order-registration__select-payment-method">
                    <div class="title">{{ __('SelectPaymentTitle') }}</div>
                    <div class="payment-type">
                        <div class="payment-type__cash active">
                            <input type="radio" id="payment-cash" name="payment_type" value="cash" checked>
                            <p class="title">{{ __('DriverCashTitle') }}</p>
                            <div class="description">
                                {{ __('DriverCashDescription') }}
                            </div>
                            <div class="question-block"><span class="question">?</span></div>
                        </div>
                        <div class="payment-type__online">
                            <input type="radio" id="payment-online" name="payment_type" value="online">
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
                        <input type="text" name="last_name" id="lastName" class="input"
                               placeholder="">
                        <label for="lastName">{{ __('LastName') }}<span class="require">*</span></label>
                    </div>
                    <div class="form-input">
                        <input type="text" name="name" id="name" class="input"
                               placeholder="">
                        <label for="name">{{ __('Name') }}<span class="require">*</span></label>
                    </div>
                    <div class="form-input">
                        <input type="text" name="middle_name" id="middleName" class="input"
                               placeholder="">
                        <label for="middleName">{{ __('MiddleName') }}</label>
                    </div>
                    @guest
                        @include('auth.phoneRequest')
                    @endguest
                    <div class="form-input">
                        <input type="email" name="email" id="email" class="input" placeholder="">
                        <label for="email">{{ __('E-Mail Address') }}<span class="require">*</span></label>
                    </div>
                    <div class="form-input">
                    <textarea name="message" id="orderMessage" cols="30" rows="4"
                              placeholder="{{ __('OrderMessage') }}"></textarea>
                    </div>

                </div>
                @include('order.Products')
            </div>
        </form>
    </div>
@endsection


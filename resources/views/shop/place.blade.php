@extends('layouts.app')
@section('description', '')
@section('title', __('Order Place'))
@section('content')
    <div class="container">
        <div class="row">
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
                    <form action="{{ route('cart.confirm') }}" method="POST">
                        @csrf
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="text" name="phone" id="phone">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="email" name="email" id="email">
                        <button type="submit" class="btn btn-active">{{ __('Send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


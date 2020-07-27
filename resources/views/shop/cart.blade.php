@php /** @var Product $product*/use App\Models\Shop\Product;@endphp
@php /** @var CartService $cartService*/use App\UseCases\Cart\CartService;@endphp
<section id="cart">
    <div class="container">
        <h1 class="title">{{ __('Cart') }}</h1>
        @if(!isset($order) && !cart())
            <div class="row">
                @include('flash.index', ['info' => __('CartEmptyMessage')])
            </div>
        @else
            <div class="cart-wrap">
                <div class="cart">
                    @foreach ($order->products as $product)
                        <div class="cart__product">
                            <div class="cart__img">
                                <a href="{{ route('product', $product->slug) }}" target="_blank">
                                    <img src="{{ fileExist("images/products/{$product->photo}.jpg") }}"
                                         alt="{{ $product->title }}"
                                         class="cart__image">
                                </a>
                            </div>
                            <div class="cart__name">
                                <a href="{{ route('product', $product->slug) }}" target="_blank"
                                   class="link cart__name-link" title="{{ $product->title }}">
                                    {{ $product->title }}
                                </a>
                            </div>
                            <div class="cart__count">
                                <div class="count">
                                    <form action="{{ route('cart.add', $product) }}" method="POST"
                                          class="addCart">
                                        @csrf
                                        <div class="product-qty">
                                            <div class="product-qty__qty">
                                                    <span class="product-qty__minus">
                                                    </span>
                                                <input type="text" class="product-qty__input"
                                                       value="{{ $product->pivot->count }}">
                                                <span class="product-qty__plus">
                                                    </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="qty-goods">
                                    @if($underOrder = $cartService->underOrder($product->pivot, $product))
                                        <p class="qty-goods__balance">{{ $underOrder['unit_pricing_base_measure'] }} в
                                            наличии</p>
                                        <p class="qty-goods__order">+ {{ $underOrder['under_order'] }} под заказ</p>
                                    @endif
                                </div>
                            </div>
                            <div class="cart__sum">
                                <p class="cart__sum-price">{{  numberFormat($product->getItemTotalSum()) }} <span
                                        class="rub">₽</span></p>
                                <div class="under-order">
                                    @if(isset($underOrder))
                                        <p class="order">+ {{ $underOrder['under_order'] }}
                                            x {{ numberFormat($product->price) }}&nbsp;<span
                                                class="rub">₽</span></p>
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('cart.remove', $product) }}" class="del-form" method="POST">
                                @csrf
                                <button type="submit" title="{{ __('ButtonCartRemove') }}" class="cart__del"></button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div class="cart-total-wrap">
                    <div class="checkout-wrap">
                    <!--<div class="cart-sale">
                            <p class="cart-total-wrap__title">{{-- __('Sale') --}}</p>
                            <p class="cart-total-wrap__total-price-sale">0 <span class="rub">₽</span></p>
                        </div>-->
                        <div class="cart-total">
                            <p class="cart-total-wrap__title bold">{{ __('Total') }}</p>
                            <p class="cart-total-wrap__total-price bold">{{ numberFormat($order->getTotalSum()) }} <span
                                    class="rub">₽</span></p>
                        </div>
                        <div class="cart-checkout">
                            <a class="btn btn-active cart-checkout__btn"
                               href="{{ route('order.place') }}">{{ __('OrderLinkTitle') }}</a>
                        </div>
                    </div>
                    <div class="primary-info" @if(!$cartService->isUnderOrder) hidden @endif>
                        <p>{{ __('UnderOrderInfo') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

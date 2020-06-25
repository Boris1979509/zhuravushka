<section id="cart">
    <div class="container">
        <h1 class="title">Корзина</h1>
        <div class="cart-wrap">
            @php /** @var Product $product*/use App\Models\Shop\Product;@endphp
            @if(is_null($order))
                <p>Ваша корзина пуста.</p>
            @else
                <div class="cart">
                    @foreach ($order->products as $product)
                        <div class="cart__product">
                            <div class="cart__img">
                                <a href="{{ route('product', $product) }}" target="_blank">
                                    <img src="{{ asset($product->photo) }}" alt="{{ $product->title }}"
                                         class="cart__image">
                                </a>
                            </div>
                            <div class="cart__name">
                                <a href="{{ route('product', $product) }}" target="_blank"
                                   class="link cart__name-link">
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
                                    <p class="qty-goods__balance">1 шт. в наличии</p>
                                    <p class="qty-goods__order">+25 шт. под заказ</p>
                                </div>

                            </div>
                            <div class="cart__sum">
                                <p class="cart__sum-price">{{  $product->numberFormat() }} <span
                                        class="rub">₽</span></p>
                                <p class="order">+25 шт. x 35 ₽</p>
                            </div>
                            <form action="{{ route('cart.remove', $product) }}" class="del-form" method="POST">
                                @csrf
                                <button type="submit" title="Убрать из корзины" class="cart__del"></button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div class="cart-total-wrap">
                    <div class="checkout-wrap">
                        <div class="cart-sale">
                            <p class="cart-total-wrap__title">Скидка:</p>
                            <p class="cart-total-wrap__total-price-sale">1 000 <span class="rub">₽</span></p>
                        </div>
                        <div class="cart-total">
                            <p class="cart-total-wrap__title bold">Итого:</p>
                            <p class="cart-total-wrap__total-price bold">{{ $order->getTotalSum() }} <span
                                    class="rub">₽</span></p>
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
            @endif
        </div>
    </div>

</section>

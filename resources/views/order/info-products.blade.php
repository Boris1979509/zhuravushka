<div class="order-registration__info">
    <div class="order-registration__info-container">
        <div class="title">{{ __('PropertiesOrderTitle') }}</div>
        @php /** @var $product Product */use App\Models\Shop\Product;@endphp
        @foreach($orderInfo->Products as $product)
            <div class="cart">
                <div class="cart__product-title">{{ $product->title }}</div>
                <div class="cart__product-item-total-sum">{{ numberFormat($product->getItemTotalSum()) }}
                    <span class="rub">₽</span>
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
                <p class="cart-total__total-sum">{{ numberFormat($orderInfo->total_cost) }} <span
                        class="rub">₽</span></p>
            </div>
        </div>
    </div>
</div>

<div class="glider-contain">
    <div class="glider" id="glider-leader-sales">
        @php /** @var Product $productItem */use App\Models\Shop\Product;@endphp
        @foreach($products as $productItem)
            <div class="card">
                <div>
                    @include('shop.cardIcons', ['product' => $productItem])
                    <div class="card__body">
                        <a href="{{ route('product', $productItem->slug) }}" title="{{ $productItem->title }}">
                            <img src="{{ fileExist("images/products/{$productItem->photo}.jpg") }}"
                                 class="card__img-top"
                                 alt="{{ $productItem->title }}">
                        </a>
                    </div>
                    <div class="card__title">
                        <a href="{{ route('product', $productItem->slug) }}"
                           class="link card__link">{{ $productItem->title }}</a>
                    </div>
                    <div class="card__footer">
                        @include('shop.priceBlock', ['product' => $productItem])
                        <form action="{{ route('cart.add', $productItem) }}" method="POST" class="addCart">
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button aria-label="Previous" class="glider-prev" id="glider-prev-leaders-sales"></button>
    <button aria-label="Next" class="glider-next" id="glider-next-leaders-sales"></button>
    <div role="tablist" class="dots"></div>
</div>

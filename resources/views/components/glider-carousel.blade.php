@if(isset($children))
    @foreach($children->take(1) as $childrenItem)
        @foreach($childrenItem->Products->take(8) as $productItem)
            <div>
                <div class="card">
                    <div class="card__body">
                        <a href="{{ route('product', $productItem->slug) }}" title="{{ $productItem->title }}">
                            <img src="{{ fileExist("ProductProductsctItem->photo}.jpg") }}"
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
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
@endif


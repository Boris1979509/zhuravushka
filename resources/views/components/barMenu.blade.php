<div class="catalog">
    <ul class="catalog__list">
        @php /** @var ProductCategory $categoryItem */use App\Models\Shop\ProductCategory;@endphp
        @foreach($productCategories as $categoryItem)
            <li class="catalog__item">
                <a href="{{ route('category' , $categoryItem->slug) }}" class="link catalog__link">
                    <img class="catalog__link-img"
                         src="{{ asset('images/icons/thumb/elektrika-i-osveshhenie.svg') }}"
                         alt="{{ $categoryItem->title }}">
                    {{ $categoryItem->title  }}</a>
                @if($categoryItem->children)
                    <div class="catalog__sub-catalog">
                        @foreach($categoryItem->children as $childrenItem)
                            <a href="{{ route('category', $childrenItem->slug) }}" class="link catalog__sub-catalog-link">{{ $childrenItem->title }} ({{  $childrenItem->productsCount }})</a>
                        @endforeach
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>

<div class="catalog__sorting">
    <div class="catalog__sorting-options">
        <span class="title">{{ __('SortBy') }}</span>
        <a href="{{ route('category', $category->slug) }}"
           class="catalog__sorting-link {{ isCurrentRoute('category', [$category->slug]) }}">{{ __('All') }}</a>
        <a href="{{ route('category', [$category->slug, 'sort=price']) }}"
           class="catalog__sorting-link {{ isCurrentRoute('category', [$category->slug, 'sort=price']) }}">{{ __('SortByPrice') }}</a>
        <a href="{{ route('category', [$category->slug,'sort=popular']) }}"
           class="catalog__sorting-link {{ isCurrentRoute('category', [$category->slug, 'sort=popular']) }}">{{ __('SortByPopular') }}</a>
        <a href="{{ route('category', [$category->slug,'sort=name']) }}"
           class="catalog__sorting-link {{ isCurrentRoute('category', [$category->slug, 'sort=name']) }}">{{ __('SortByName') }}</a>
        <div
            class="sort-in-stock catalog__sorting-link @if(request()->has('sortInStock')) active @endif">
            <form action="{{ route('category', $category->slug) }}" method="GET">
                <input type="checkbox" name="sortInStock" class="catalog__sorting-link"
                       id="sort-in-stock" onchange="this.form.submit()"
                       @if(request()->has('sortInStock')) checked @endif>
                <label for="sort-in-stock">{{ __('SortInStock') }}</label>
            </form>
        </div>
    </div>

    <div class="catalog__sorting-icons">
        <div class="mode-tile active" title="{{ __('Tile') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M15 9H9V15H15V9Z" fill="#C0C0C0"/>
                <path d="M5.99998 0H0V5.99998H5.99998V0Z" fill="#C0C0C0"/>
                <path d="M15 18H9V24H15V18Z" fill="#C0C0C0"/>
                <path d="M5.99998 9H0V15H5.99998V9Z" fill="#C0C0C0"/>
                <path d="M5.99998 18H0V24H5.99998V18Z" fill="#C0C0C0"/>
                <path d="M24 0H18V5.99998H24V0Z" fill="#C0C0C0"/>
                <path d="M15 0H9V5.99998H15V0Z" fill="#C0C0C0"/>
                <path d="M24 9H18V15H24V9Z" fill="#C0C0C0"/>
                <path d="M24 18H18V24H24V18Z" fill="#C0C0C0"/>
            </svg>
        </div>
        <div class="mode-simple" title="{{ __('Simple') }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0H5V6H0V0Z" fill="#C0C0C0"/>
                <path d="M8 0H24V6H8V0Z" fill="#C0C0C0"/>
                <path d="M0 9H5V15H0V9Z" fill="#C0C0C0"/>
                <path d="M8 9H24V15H8V9Z" fill="#C0C0C0"/>
                <path d="M0 18H5V24H0V18Z" fill="#C0C0C0"/>
                <path d="M8 18H24V24H8V18Z" fill="#C0C0C0"/>
            </svg>
        </div>
    </div>
</div>

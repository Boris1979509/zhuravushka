<form action="{{ route('category', $category->slug) }}" method="GET">
    <div class="catalog__price form-label">
        <span class="catalog__price-title">{{ __('PriceTitle') }}</span>
        <div class="catalog__price__wrapper">
            <div class="form-input">
                <input type="number" name="priceFrom" placeholder=""
                       value="{{ request()->input('priceFrom') }}"
                       class="input catalog__price-from" id="price-from" autocomplete="off">
                <label for="price-from">{{ __('From') }}</label>
            </div>
            <span class="line">—</span>
            <div class="form-input">
                <input type="number" name="priceTo" placeholder=""
                       value="{{ request()->input('priceTo') }}"
                       class="input catalog__price-to" id="price-to" autocomplete="off">
                <label for="price-to">{{ __('To') }}</label>
            </div>
        </div>
        @if($errors->count())
            <ul class="invalid-feedback">
                @foreach ($errors->all() as $message)
                    <li class="invalid-feedback__item">{{ $message }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    @foreach($attributes as $itemAttribute)
        <div class="catalog__attributes">
            <div
                class="catalog__attributes-title @if(request()->has($itemAttribute->slug)) active @endif">{{ $itemAttribute->title }}</div>
            <div class="catalog__attributes__wrapper"
                 @if(!request()->has($itemAttribute->slug)) hidden @endif>
                <div class="catalog__attributes__word__wrap">
                    @foreach($itemAttribute->values as $itemValue)
                        <div class="form-input">
                            <input type="checkbox" id="{{ $itemValue->slug }}"
                                   name="{{ $itemAttribute->slug . '[]' }}" value="{{ $itemValue->id }}"
                                   class="catalog__attributes-input" title="{{ $itemValue->title }}"
                                   @if(in_array($itemValue->id, (array) request()->input($itemAttribute->slug))) checked @endif>
                            <label for="{{ $itemValue->slug }}">{{ $itemValue->title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    <input type="hidden" name="start_filter" value="true">
    <div class="catalog__confirm">
        <div class="catalog__confirm__wrapper">
            <button type="submit" class="btn btn-outline btn__confirm">{{ __('Apply') }}</button>
            <a href="{{ route('category', $category->slug) }}"
               class="btn__clear">{{ __('Clear') }}</a>
        </div>
    </div>
</form>

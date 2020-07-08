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
    <div class="catalog__brand">
        <div class="catalog__brand-title">{{ __('BrandTitle') }}</div>
        <div class="catalog__brand__wrapper" @if(!request()->has('brand')) hidden @endif>
            <ul>
                <div class="catalog__word__wrap">
                    <div class="form-input">
                        <input type="checkbox" id="ladogaz" name="brand[]" value="ladogaz"
                               class="catalog__brand-input">
                        <label for="ladogaz">Ладогаз</label>
                    </div>
                    <div class="form-input">
                        <input type="checkbox" id="lemax" name="brand[]" value="lemax"
                               class="catalog__brand-input">
                        <label for="lemax">ЛЕМАКС</label>
                    </div>
                    <div class="form-input">
                        <input type="checkbox" name="brand[]" id="ariston" value="ariston"
                               class="catalog__brand-input">
                        <label for="ariston">Ariston</label>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <div class="catalog__confirm">
        <div class="catalog__confirm__wrapper">
            <button type="submit" class="btn btn-active btn__confirm">{{ __('Apply') }}</button>
            <a href="{{ route('category', $category->slug) }}"
               class="btn__clear">{{ __('Clear') }}</a>
        </div>
    </div>
</form>

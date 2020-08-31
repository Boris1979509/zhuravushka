<div class="product-tabs">
    <nav class="tabs-nav">
        <ul>
            <li class="tabs-nav__item active">{{ __('InfoProduct') }}</li>
            <li class="tabs-nav__item">Отзывы <span class="count">0</span></li>
            <li class="tabs-nav__item">Советы <span class="count">0</span></li>
        </ul>
    </nav>

    <div class="tabs-content">
        <div class="tabs-content__item">
            <div class="characteristics"><h2>Характеристики</h2>
                @forelse ($product->attributes as $attr)
                    <div class="characteristics__props">
                        <p class="characteristics__props-name">{{ mb_ucfirst($attr->attr_name) }}</p>
                        <p class="characteristics__props-value">{{ $attr->attr_value }}</p>
                    </div>
                @empty
                    @include('flash.index', ['info' => __('During the adding process')])
                @endforelse
            </div>
        </div>
        <div class="tabs-content__item">
            @include('flash.index', ['info' => __('NoComments')])
        </div>
        <div class="tabs-content__item">
            @include('flash.index', ['info' => __('NoRecommendations')])
        </div>
    </div>
</div>

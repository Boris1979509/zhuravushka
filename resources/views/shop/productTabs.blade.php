<div class="product-tabs">
    <nav class="tabs-nav">
        <ul>
            <li class="tabs-nav__item">{{ __('InfoProduct') }}</li>
            {{--            <li class="tabs-nav__item">Отзывы</li>--}}
            <li class="tabs-nav__item">Советы</li>
        </ul>
    </nav>

    <div class="tabs-content">
        <div class="tabs-content__item">
            <p class="description">{{ $product->description }}</p>
        {{--            <div class="characteristics">--}}
        {{--<h2>Характеристики</h2>--}}
        <!--<div class="characteristics__props">
                    <p class="characteristics__props-name">Расположение</p>
                    <p class="characteristics__props-value">вертикальное</p>
                </div>
                <div class="characteristics__props">
                    <p class="characteristics__props-name">Мощность</p>
                    <p class="characteristics__props-value">1500 Вт</p>
                </div>
                <div class="characteristics__props">
                    <p class="characteristics__props-name">Объем бака</p>
                    <p class="characteristics__props-value">50 л</p>
                </div>
                <div class="characteristics__props">
                    <p class="characteristics__props-name">Вес</p>
                    <p class="characteristics__props-value">17 кг</p>
                </div>
                <div class="characteristics__props">
                    <p class="characteristics__props-name">Максимальное давление</p>
                    <p class="characteristics__props-value">6 бар</p>
                </div>
                <div class="characteristics__props">
                    <p class="characteristics__props-name">Максимальная температура воды</p>
                    <p class="characteristics__props-value">75°C</p>
                </div>
                <div class="characteristics__props">
                    <p class="characteristics__props-name">Габариты (ВхШхГ)</p>
                    <p class="characteristics__props-value">553х450х480 мм</p>
                </div>
                <div class="characteristics__props">
                    <p class="characteristics__props-name">Форма бака</p>
                    <p class="characteristics__props-value">прямоугольный</p>
                </div>-->
            {{--            </div>--}}
        </div>
        <div class="tabs-content__item">
            @include('flash.index', ['info' => __('During the adding process')])
        </div>
        <div class="tabs-content__item">
            @include('flash.index', ['info' => __('During the adding process')])
        </div>
    </div>
</div>

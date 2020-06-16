<div class="homepage-top-tabs-category">
    <nav class="tabs-nav">
        <ul>
            <li class="tabs-nav__item">Сезонные предложения</li>
            <li class="tabs-nav__item">Для строительства</li>
            <li class="tabs-nav__item">Для ремонта</li>
            <li class="tabs-nav__item">Для сада и огорода</li>
        </ul>
    </nav>

    <div class="tabs-content">
        <div class="glider-contain">
            <div class="tabs-content__item">
                @include('components.glider-carousel')
            </div>
            <div class="tabs-content__item">
                @include('components.glider-carousel')
            </div>
            <div class="tabs-content__item">
                @include('components.glider-carousel')
            </div>
            <div class="tabs-content__item">
                @include('components.glider-carousel')
            </div>

            <button aria-label="Previous" class="glider-prev"></button>
            <button aria-label="Next" class="glider-next"></button>
            <div role="tablist" class="dots"></div>
        </div>
    </div>
</div>

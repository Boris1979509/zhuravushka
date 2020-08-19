<div class="b-carousel">
    <div id="home-slider">
        <div>
            <div class="home-slider__rectangle">
                <div class="home-slider__info">
                    <div class="home-slider__title">АКЦИЯ!!!</div>
                    <p class="home-slider__subtitle">Успей все раскупить до конца акции!</p>
                    <button class="btn btn-active home-slider__btn">Узнать подробнее...</button>
                </div>
            </div>
            <img src="{{ asset('images/homepage-slider/Rectangle1.jpg') }}" alt=""
                 class="b-carousel__img">
        </div>
        <div>
            <div class="home-slider__rectangle">
                <div class="home-slider__info">
                    <div class="home-slider__title">АКЦИЯ!!!</div>
                    <p class="home-slider__subtitle">Успей все раскупить до конца акции!</p>
                    <button class="btn btn-active home-slider__btn">Узнать подробнее...</button>
                </div>
            </div>
            <img src="{{ asset('images/homepage-slider/Rectangle1.jpg') }}" alt=""
                 class="b-carousel__img">
        </div>
        <div>
            <div class="home-slider__rectangle">
                <div class="home-slider__info">
                    <div class="home-slider__title">АКЦИЯ!!!</div>
                    <p class="home-slider__subtitle">Успей все раскупить до конца акции!</p>
                    <button class="btn btn-active home-slider__btn">Узнать подробнее...</button>
                </div>
            </div>
            <img src="{{ asset('images/homepage-slider/Rectangle1.jpg') }}" alt=""
                 class="b-carousel__img">
        </div>
    </div>
</div>
@section('script')
    <script>
        const slider = tns({
            container: '#home-slider',
            nav: false,
            autoplayButtonOutput: false,
            controlsText: ["", ""],
            autoplayHoverPause: true,
            "mouseDrag": true,
            items: 1,
            slideBy: 'page',
            autoplay: true
        });
    </script>
@endsection

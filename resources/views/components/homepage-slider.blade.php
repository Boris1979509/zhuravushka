<div class="b-carousel">
    <div class="my-slider">
        <div>
            <img src="{{ asset('images/homepage-slider/Rectangle1.jpg') }}" alt=""
                 class="b-carousel__img">
        </div>
        <div>
            <img src="{{ asset('images/homepage-slider/Rectangle1.jpg') }}" alt=""
                 class="b-carousel__img">
        </div>
        <div>
            <img src="{{ asset('images/homepage-slider/Rectangle1.jpg') }}" alt=""
                 class="b-carousel__img">
        </div>
    </div>
</div>
@section('script')
    <script>
        const slider = tns({
            container: '.my-slider',
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

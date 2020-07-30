<h3>{{ __('DontForgetToBuy') }}</h3>
<div class="glider-contain">
    <div class="glider" id="more-goods">
        @include('shop.card')
    </div>
    <button aria-label="Previous" class="glider-prev" id="glider-prev-more-goods"></button>
    <button aria-label="Next" class="glider-next" id="glider-next-more-goods"></button>
    <div role="tablist" class="glider-dots" id="more-goods-dots"></div>
</div>
@section('script')
    <script>
        ((elem) => {
            if (!elem)
                return;
            new Glider(elem, {
                slidesToShow: 2,
                slidesToScroll: 2,
                propagateEvent: false,
                draggable: false,
                dots: '#more-goods-dots',
                arrows: {
                    prev: '#glider-prev-more-goods',
                    next: '#glider-next-more-goods'
                }
            });
        })(document.getElementById('more-goods'));
    </script>
@endsection

<div class="page-top-grid__menu"><!--Start barMenu-->
    <div class="menu-desktop">
        @php /** @var ShopCategory $categoryItem */use App\Models\Shop\ShopCategory;@endphp
        @foreach($shopCategory as $categoryItem)
            <div class="menu-desktop__root">
                <img class="menu-desktop__root-icon"
                     src="{{ asset('images/icons/thumb/' . $categoryItem->slug . '.svg') }}"
                     alt="{{ $categoryItem->title }}">
                <div class="menu-desktop__root-info">
                    <a class="link menu-desktop__root-title"
                       href="/catalog/id/slug/">{{ $categoryItem->title  }}</a>
                    <!--<div class="menu-desktop__root-subtitles">
                        <a class="link menu-desktop__root-subtitle" href=""></a>
                    </div>-->
                </div>
            </div>
        @endforeach
    </div>
</div><!--End barMenu -->

<section id="page-nav-menu">
    <ul class="page-nav-menu">
        @php /** @var Page $pageItem  */use App\Models\Shop\Page;@endphp
        @foreach($pagesNav as $key => $pageItem)
            <li class="page-nav-menu__item @if (url()->current() === route('page', $pageItem->slug)) active @endif">
                <a href="{{ route('page', $pageItem->slug) }}" class="link page-nav-menu__link"
                   title="{{ $pageItem->title }}">
                    {{ $pageItem->title }}
                </a>
            </li>
        @endforeach
    </ul>
</section>

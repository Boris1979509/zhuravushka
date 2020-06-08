@php /** @var Page $pageItem  */use App\Models\Shop\Page;@endphp
<section id="page-nav-menu">
    <ul class="page-nav-menu">
        @if(count($pagesNav))
            @foreach($pagesNav as $pageItem)
                <li class="page-nav-menu__item @if (url()->current() === url('page', $pageItem->slug)) active @endif">
                    <a href="{{ route('page', $pageItem->slug) }}" class="link page-nav-menu__link"
                       title="{{ $pageItem->title }}">
                        {{ $pageItem->title }}
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</section>

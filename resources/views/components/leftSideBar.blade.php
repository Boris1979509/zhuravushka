<div class="side-bar">
    <ul class="side-bar__list">
        @php /** @var Page $item */use App\Models\Shop\Page; @endphp
        @foreach($children as $item)
            <li class="side-bar__item {{ isCurrentRoute('page/uslugi', [$item->slug]) }}">
                <a class="link side-bar__link" title="{{ $item->title }}"
                   href="{{ url('page/uslugi', $item->slug) }}">{{ $item->title }}</a>
            </li>
        @endforeach
    </ul>
</div>


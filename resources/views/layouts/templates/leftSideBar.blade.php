<div class="side-bar">
    <ul class="side-bar__list">
        @foreach($children as $item)
            <li class="side-bar__item  @if (url()->current() === url('page/' . $item->parent->slug . '/' . $item->slug)) active @endif">
                <a class="link side-bar__link"
                   href="{{ url('page/' . $item->parent->slug . '/' . $item->slug) }}">{{ $item->title }}</a>
            </li>
        @endforeach
    </ul>
</div>


<div class="side-bar">
    <ul class="side-bar__list">
        @forelse($page->children as $child)
            <li class="side-bar__item  @if (url()->current() === route('page', $child->slug)) active @endif">
                <a class="link side-bar__link" href="{{ route('page', $child->slug) }}">{{ $child->title }}</a>
            </li>
        @empty

        @endforelse
    </ul>
</div>


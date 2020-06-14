<div class="side-bar">
    <ul class="side-bar__list">
        <li class="side-bar__item {{ isCurrentRoute('blog') }}">
            <a class="link side-bar__link "
               href="{{ route('blog') }}" title="Все советы">Все советы</a>
        </li>
        @php /** @var BlogCategory $category
        */use App\Models\Blog\BlogCategory; @endphp
        @foreach($blogCategories as $category)
            <li class="side-bar__item {{ isCurrentRoute('blog/category', [$category->slug]) }}">
                <a class="link side-bar__link"
                   href="{{ route('blog.category', $category->slug) }}"
                   title="{{ $category->title }}">{{ $category->title }}&nbsp;<span
                        class="post-count">{{ $category->post_count }}</span></a>
            </li>
        @endforeach
    </ul>
</div>

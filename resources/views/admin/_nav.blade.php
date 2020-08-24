<div class="admin-nav">
    <div class="admin-nav__options">
        <a href="{{ route('admin.home') }}"
           class="admin-nav__link{{ $page === '' ? ' active' : '' }}">{{ __('Dashboard') }}</a>
        <a href="{{ route('admin.users.index') }}"
           class="admin-nav__link{{ $page === 'users' ? ' active' : '' }}">{{ __('Users') }}</a>
        <a href="{{ route('admin.blog.posts.index') }}"
           class="admin-nav__link{{ $page === 'blog' ? ' active' : '' }}">{{ __('Blog') }}</a>
    </div>
    <div class="admin-nav__logout">
        @include('cabinet.logout.logout')
    </div>
</div>

<div class="cabinet__sorting">
    <div class="cabinet__sorting-options">
        <a href="{{ route('admin.home') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('admin.home') }}">{{ __('Dashboard') }}</a>
        <a href="{{ route('admin.users.index') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('admin.users.index') }}">{{ __('Users') }}</a>
        <a href="{{ route('admin.users.edit') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('admin.users.edit') }}">{{ __('UsersShow') }}</a>
    </div>

    <div class="cabinet__sorting-logout">
        @include('cabinet.logout.logout')
    </div>
</div>

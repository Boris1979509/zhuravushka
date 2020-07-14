<div class="cabinet__sorting">
    <div class="cabinet__sorting-options">
        <a href="{{ route('cabinet.home') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.home') }}">{{ __('Cabinet') }}</a>
        <a href="{{ route('cabinet.order') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.order') }}">{{ __('CabinetOrder') }}</a>
        <a href="{{ route('cabinet.comment') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.comment') }}">{{ __('CabinetComment') }}</a>
        <a href="{{ route('cabinet.feedback') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.feedback') }}">{{ __('CabinetFeedBack') }}</a>
        <a href="{{ route('cabinet.profile.edit') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.profile.edit') }}">{{ __('ProfileSetting') }}</a>
        <a href="{{ route('cabinet.favorite') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.favorite') }}">{{ __('Favorite') }}</a>
    </div>

    <div class="cabinet__sorting-logout">
        <a class="link" href="{{ route('logout') }}" title="{{ __('LogOut') }}">{{ __('LogOut') }}</a>
    </div>
</div>

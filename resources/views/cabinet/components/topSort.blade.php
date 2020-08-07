<div class="cabinet__sorting">
    <div class="cabinet__sorting-options">
        <a href="{{ route('cabinet.order') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.order') }}">{{ __('CabinetOrder') }}</a>
        <a href="{{ route('cabinet.comment') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.comment') }}">{{ __('CabinetComment') }}</a>
        <a href="{{ route('cabinet.feedback') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.feedback') }}">{{ __('CabinetFeedBack') }}</a>
        <a href="{{ route('cabinet.profile.edit') }}"
           class="cabinet__sorting-link {{ isCurrentRoute('cabinet.profile.edit') }}">{{ __('ProfileSetting') }}</a>
    </div>
    <div class="cabinet__sorting-logout">
        @include('cabinet.logout.logout')
    </div>
</div>

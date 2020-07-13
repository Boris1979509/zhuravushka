<div class="cabinet__sorting">
    <div class="cabinet__sorting-options">
        <a href="{{-- route('category', $category->slug) --}}"
           class="cabinet__sorting-link {{-- isCurrentRoute('category', [$category->slug]) --}} active">{{ __('CabinetOrders') }}</a>
        <a href="{{-- route('category', [$category->slug, 'sort=price']) --}}"
           class="cabinet__sorting-link {{-- isCurrentRoute('category', [$category->slug, 'sort=price']) --}}">{{ __('CabinetComments') }}</a>
        <a href="{{-- route('category', [$category->slug,'sort=popular']) --}}"
           class="cabinet__sorting-link {{-- isCurrentRoute('category', [$category->slug, 'sort=popular']) --}}">{{ __('CabinetFeedBack') }}</a>
        <a href="{{-- route('category', [$category->slug,'sort=name']) --}}"
           class="cabinet__sorting-link {{-- isCurrentRoute('category', [$category->slug, 'sort=name']) --}}">{{ __('ProfileSetting') }}</a>
        <a href="{{-- route('category', [$category->slug,'sort=name']) --}}"
           class="cabinet__sorting-link {{-- isCurrentRoute('category', [$category->slug, 'sort=name']) --}}">{{ __('ProfileFavorite') }}</a>
    </div>

    <div class="cabinet__sorting-logout">
        <a class="link" href="{{ route('logout') }}" title="{{ __('LogOut') }}">{{ __('LogOut') }}</a>
    </div>
</div>

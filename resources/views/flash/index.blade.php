@if(session('message'))
    <div class="alert alert-info">
        <div class="alert-info__icon">
            <img src="{{ asset('images/icons/alerts/info.svg') }}" alt="info">
        </div>
        <div class="alert-info__message">
            <p>{{ session('message') }}</p>
        </div>
        <div class="alert-info__close">
            <span class="alert-info__close__icon-close" title="{{ __('Close') }}"></span>
        </div>
    </div>
@endif

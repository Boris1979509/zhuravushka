@if(session('info') || isset($info))
    <div class="alert alert-info">
        <div class="alert-info__icon">
            <img src="{{ asset('images/icons/alerts/info.svg') }}" alt="info">
        </div>
        <div class="alert-info__message">
            <p>{{ session('info') ?? $info }}</p>
        </div>
        @if(session('info'))
            <div class="alert-info__close">
                <span class="alert-info__close__icon-close" title="{{ __('Close') }}"></span>
            </div>
        @endif
    </div>
@endif

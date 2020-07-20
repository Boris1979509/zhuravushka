@if(session('info') || isset($info))
    <div class="alert alert-info">
        <div class="alert-info__icon">
            <img src="{{ asset('images/icons/alerts/info.svg') }}" alt="info">
        </div>
        <div class="alert-info__message">
            <p>{{ session('info') ?? $info }}</p>
        </div>
        @if(session('info'))
            <span class="close alert-info__icon-close" title="{{ __('Close') }}"></span>
        @endif
    </div>
@endif
@if(session('error') || isset($error))
    <div class="alert alert-error">
        <div class="alert-error__icon">
            <img src="{{ asset('images/icons/alerts/error.svg') }}" alt="info">
        </div>
        <div class="alert-error__message">
            <p>{{ session('error') ?? $error }}</p>
        </div>
        <span class="close alert-error__icon-close" title="{{ __('Close') }}"></span>
    </div>
@endif
@if(session('success') || isset($success))
    <div class="alert alert-success">
        <div class="alert-success__icon">
            <img src="{{ asset('images/icons/alerts/success.svg') }}" alt="info">
        </div>
        <div class="alert-success__message">
            <p>{{ session('success') ?? $success }}</p>
        </div>
        <span class="close alert-success__icon-close" title="{{ __('Close') }}"></span>
    </div>
@endif

@section('script')
    <script>
        ((close) => {
            if (!close) return;
            close.addEventListener('click', () => {
                close.closest('.alert').remove();
            });
        })(document.querySelector('.alert .close'));
    </script>
@endsection

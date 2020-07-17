<div class="phone-verify">
    <form method="POST" action="{{ route('phone.request') }}" class="form-request-phone">
        @csrf
        <div class="request-block">
            <div class="form-input">
                <label for="phone" class="form-input-label">{{ __('Phone') }}</label>
                <input type="tel" name="phone" id="phone" class="input mask-input"
                       placeholder="+7 (666) 555-55-55"
                       pattern="(\+7[-_()\s]+|\+7\s?[(]{0,1}[0-9]{3}[)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2})"
                       autocomplete="off" autofocus value="{{ session('phone') }}">

                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input">
                <button type="submit" class="btn btn-active"
                        id="number-btn">{{ __('ButtonTitleConfirmPhone') }}</button>
            </div>
        </div>
    </form>
    <div class="verify-block-form">
        {{--        @include('auth.phoneVerify')--}}
    </div>
</div>

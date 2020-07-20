<div class="phone-verify">
    <div class="form-request-phone">
        <div class="request-block">
            <div class="form-input">
                @if(url()->current() === route('register'))
                <label for="phone" class="form-input-label">{{ __('Phone') }}</label>
                @endif
                <input type="tel" name="phone" id="phone" class="input mask-input"
                       placeholder="@if(url()->current() === route('register')) +7 (666) 555-55-55 @endif"
                       pattern="(\+7[-_()\s]+|\+7\s?[(]{0,1}[0-9]{3}[)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2})"
                       autocomplete="off" autofocus value="{{ session('phone') }}">
                    @if(url()->current() === route('cart.place'))
                        <label for="phone">{{ __('Phone') }}</label>
                    @endif
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-input">
                <button class="btn btn-active"
                        id="number-btn">{{ __('ButtonTitleConfirmPhone') }}</button>
            </div>
        </div>
    </div>
    <div class="verify-block-form" hidden>
        @include('auth.phoneVerify')
    </div>
</div>

<div class="form-verify-phone">
    <div class="verify-block">
        <div class="form-input">
            @if(url()->current() === route('register'))
                <label for="verifyToken" class="form-input-label">{{ __('CodeConfirmBy') }}</label>
            @endif
            <input type="text" name="verifyToken" maxlength="4" placeholder=""
                   id="verifyToken"
                   class="input" autocomplete="off">
            @if(url()->current() === route('cart.place'))
                <label for="verifyToken">{{ __('CodeConfirmBy') }}</label>
            @endif
        </div>
        <div class="form-input verify-block-timer"></div>
    </div>
</div>


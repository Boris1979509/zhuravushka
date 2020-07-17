<form method="POST" action="{{ route('phone.verify') }}" class="form-verify-phone">
    @csrf
    <div class="verify-block">
        <div class="form-input">
            <label for="verifyToken" class="form-input-label">{{ __('CodeConfirmBy') }}</label>
            <input type="text" name="verifyToken" maxlength="4" placeholder="{{ __('CodeConfirmBy') }}"
                   id="verifyToken"
                   class="input">
        </div>
        <div class="form-input verify-block-timer"></div>
    </div>
</form>

<div class="phone-verify">
    <form method="POST" action="{{ route('phone.verify') }}" class="phone-verify__form">
    @csrf
    <!---->
        <div class="register__number-send-block">
            <div class="input-phone-block">
                <div class="form-input">
                    <label for="phone" class="form-input-label">{{ __('Phone') }}</label>
                    <input type="tel" name="phone" id="phone" class="input mask-input"
                           placeholder="+7 (666) 555-55-55"
                           pattern="(\+7[-_()\s]+|\+7\s?[(]{0,1}[0-9]{3}[)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2})"
                           autocomplete="off" autofocus>

                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-input">
                    <button type="submit" class="btn btn-active"
                            id="number-btn">{{ __('ButtonTitleConfirmPhone') }}</button>
                </div>
            </div>
            <div class="input-phone-confirm" style="display: none;">
                <div class="form-input">
                    <label for="verifyToken" class="form-input-label">{{ __('CodeConfirmBy') }}</label>
                    <input type="text" name="verifyToken" maxlength="4" placeholder="{{ __('CodeConfirmBy') }}"
                           id="verifyToken"
                           class="input">
                </div>
                <div class="form-input">
                    <span class="confirm-timer">Повторная отправка будет доступна через 0 сек.</span>
                    <a href="#" class="link code-confirm">Отправить еще раз</a>
                </div>
            </div>
        </div>
    </form>
</div>

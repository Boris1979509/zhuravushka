@extends('layouts.app')

@section('content')
    <section id="register">
        <div class="container">
            <div class="row">
                <div class="register">
                    <h1>{{ __('Registration') }}</h1>
                    <form method="POST" action="{{ route('register') }}" class="register__form">
                    @csrf
                    <!---->
                        <div class="register__number-send-block">
                            <div class="input-phone-block">
                                <div class="form-input">
                                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                    <input type="text" name="phone" id="phone" class="input mask-input"
                                           placeholder="+7 (666) 555-55-55"
                                           pattern="(\+7[-_()\s]+|\+7\s?[(]{0,1}[0-9]{3}[)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2})"
                                           autocomplete="off" autofocus>

                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-input">
                                    <button class="btn btn-active"
                                            id="number-btn">{{ __('ButtonTitleConfirmPhone') }}</button>
                                </div>
                            </div>
                            <div class="input-phone-confirm">
                                <div class="form-input">
                                    <label for="confirmCode" class="form-label">{{ __('CodeConfirmBy') }}</label>
                                    <input type="number" placeholder="{{ __('CodeConfirmBy') }}" id="confirmCode"
                                           class="input">
                                </div>
                                <div class="form-input">
                                    <span class="confirm-timer">Повторная отправка будет доступна через 0 сек.</span>
                                    <a href="#" class="link code-confirm">Отправить еще раз</a>
                                </div>
                            </div>
                        </div>
                        <!---->
                        <div class="register__userData">
                            <h2>{{ __('UserDataTitle') }}</h2>
                            <div class="form-input">
                                <label for="lastName" class="form-label">{{ __('LastName') }}</label>
                                <input type="text" name="lastName" id="lastName" class="input"
                                       placeholder="{{ __('LastName') }}">
                                @error('lastName')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="firstName" class="form-label">{{ __('FirstName') }}</label>
                                <input type="text" name="firstName" id="firstName" class="input"
                                       placeholder="{{ __('FirstName') }}" autocomplete="name">
                                @error('firstName')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="middleName" class="form-label">{{ __('MiddleName') }}</label>
                                <input type="text" name="middleName" id="middleName" class="input"
                                       placeholder="{{ __('MiddleName') }}" autocomplete="name">
                                @error('middleName')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" class="input"
                                       placeholder="{{ __('Email') }}" autocomplete="email">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input type="password" name="password" id="password" class="input"
                                       autocomplete="new-password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="passwordConfirm" class="form-label">{{ __('PasswordConfirm') }}</label>
                                <input type="password" name="passwordConfirm" id="passwordConfirm" class="input"
                                       autocomplete="new-password">
                                @error('passwordConfirm')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <button type="submit" class="btn btn-active">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

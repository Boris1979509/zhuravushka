@extends('layouts.app')

@section('content')
    <section id="register">
        <div class="container">
            <h1>{{ __('Registration') }}</h1>
            <div class="message"></div>
            <div class="row">
                <div class="register">
                    @include('auth.phoneRequest')
                    <form method="POST" action="{{ route('register') }}" class="register__form" id="register-form">
                        @csrf
                        <div class="register__userData">
                            <h2>{{ __('UserDataTitle') }}</h2>
                            <div class="form-input">
                                <label for="lastName" class="form-input-label">{{ __('LastName') }}</label>
                                <input type="text" name="last_name" id="lastName" class="input"
                                       placeholder="{{ __('LastName') }}" value="{{ old('last_name') }}">
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="name" class="form-input-label">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" class="input"
                                       placeholder="{{ __('Name') }}" autocomplete="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="middleName" class="form-input-label">{{ __('MiddleName') }}</label>
                                <input type="text" name="middle_name" id="middleName" class="input"
                                       placeholder="{{ __('MiddleName') }}" autocomplete="name"
                                       value="{{ old('middle_name') }}">
                                @error('middle_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="email" class="form-input-label">{{ __('E-Mail Address') }}</label>
                                <input type="email" name="email" id="email" class="input"
                                       placeholder="{{ __('E-Mail Address') }}" autocomplete="email"
                                       value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="password" class="form-input-label">{{ __('Password') }}</label>
                                <input type="password" name="password" id="password" class="input"
                                       autocomplete="new-password" placeholder="{{ __('Password') }}">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="passwordConfirm"
                                       class="form-input-label">{{ __('PasswordConfirm') }}</label>
                                <input type="password" name="password_confirmation" id="passwordConfirm" class="input"
                                       autocomplete="new-password" placeholder="{{ __('PasswordConfirm') }}">
                                @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-control p_rel registration__address-wrap">
                                <!--<p class="text-style strong">
                                    Указать адрес доставки
                                </p>
                                <div class="registration__address-controls">
                                    <div class="registration__address-yes">Да</div>
                                    <div class="registration__hr"></div>
                                    <div class="registration__address-no r_controls_active">Позже</div>
                                </div>-->
                                <div class="form-input">
                                    <label for="address"
                                           class="form-input-label">{{ __('SpecifyDeliveryAddress') }}</label>
                                    <input type="text" name="address" id="address" class="input"
                                           placeholder="{{ __('SpecifyDeliveryAddress') }}"
                                           value="{{ old('address') }}">
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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

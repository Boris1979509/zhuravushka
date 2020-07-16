@extends('layouts.app')

@section('content')
    <section id="register">
        <div class="container">
            <div class="row">
                <div class="register">
                    <h1>{{ __('Registration') }}</h1>
                    @include('auth.phoneRequest')
                    <form method="POST" action="{{ route('register') }}" class="register__form">
                        @csrf
                        <div class="register__userData">
                            <h2>{{ __('UserDataTitle') }}</h2>
                            <div class="form-input">
                                <label for="lastName" class="form-input-label">{{ __('LastName') }}</label>
                                <input type="text" name="lastName" id="lastName" class="input"
                                       placeholder="{{ __('LastName') }}">
                                @error('lastName')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="firstName" class="form-input-label">{{ __('FirstName') }}</label>
                                <input type="text" name="firstName" id="firstName" class="input"
                                       placeholder="{{ __('FirstName') }}" autocomplete="name">
                                @error('firstName')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="middleName" class="form-input-label">{{ __('MiddleName') }}</label>
                                <input type="text" name="middleName" id="middleName" class="input"
                                       placeholder="{{ __('MiddleName') }}" autocomplete="name">
                                @error('middleName')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-input">
                                <label for="email" class="form-input-label">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" class="input"
                                       placeholder="{{ __('Email') }}" autocomplete="email">
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
                                <input type="password" name="passwordConfirm" id="passwordConfirm" class="input"
                                       autocomplete="new-password" placeholder="{{ __('PasswordConfirm') }}">
                                @error('passwordConfirm')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-control p_rel registration__address-wrap">
                                <p class="text-style strong">
                                    Указать адрес доставки
                                </p>
                                <div class="registration__address-controls">
                                    <div class="registration__address-yes">Да</div>
                                    <div class="registration__hr"></div>
                                    <div class="registration__address-no r_controls_active">Позже</div>
                                </div>
                                <div class="form-input">
                                    <label for="address" class="form-input-label">{{ __('Address') }}</label>
                                    <input type="password" name="address" id="address" class="input"
                                           placeholder="{{ __('Address') }}">
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

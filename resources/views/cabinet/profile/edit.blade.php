@extends('layouts.app')
@section('title', __('CabinetProfileEdit'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet edit-profile">
                <h1>{{ __('CabinetProfileEdit') }}</h1>
                @include('cabinet.profile._nav')
                <form method="POST" action="{{ route('cabinet.profile.update') }}">
                    @csrf
                    <div class="update-profile grid">
                        <div class="form-input">
                            <label for="name" class="form-input-label">{{ __('Name') }}<span
                                    class="require">*</span></label>
                            <input type="text" name="name" id="name" class="input"
                                   placeholder="{{ __('Name') }}" autocomplete="name" value="{{ $user->name }}"
                                   autofocus>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="lastName" class="form-input-label">{{ __('LastName') }}<span
                                    class="require">*</span></label></label>
                            <input type="text" name="last_name" id="lastName" class="input"
                                   placeholder="{{ __('LastName') }}" value="{{ $user->last_name }}">
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="middleName" class="form-input-label">{{ __('MiddleName') }}<span
                                    class="require">*</span></label></label>
                            <input type="text" name="middle_name" id="middleName" class="input"
                                   placeholder="{{ __('MiddleName') }}" autocomplete="name"
                                   value="{{ $user->middle_name }}">
                            @error('middle_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="phone" class="form-input-label">{{ __('Phone') }}<span
                                    class="require">*</span></label>
                            <input type="tel" name="phone" id="phone" class="input"
                                   placeholder="{{ __('Phone') }}" readonly value="{{ $user->phone }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label for="email" class="form-input-label">{{ __('E-Mail Address') }}<span
                                    class="require">*</span></label>
                            <input type="email" name="email" id="email" class="input"
                                   placeholder="{{ __('E-Mail Address') }}" autocomplete="email"
                                   value="{{ $user->email }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

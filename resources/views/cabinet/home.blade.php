@extends('layouts.app')
@section('title', __('Cabinet'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet">
                <h1>{{ __('Cabinet') }}</h1>
                <div class="cabinet__home">
                    <a href="{{ route('cabinet.order') }}"
                       class="cabinet__home-link">{{ __('CabinetOrder') }}<span class="count">{{ $user->orders->count() }}</span></a>
                    <a href="{{ route('cabinet.comment') }}"
                       class="cabinet__home-link">{{ __('CabinetComment') }}<span class="count">0</span></a>
                    <a href="{{ route('cabinet.feedback') }}"
                       class="cabinet__home-link">{{ __('CabinetFeedBack') }}</a>
                    <a href="{{ route('cabinet.profile.home') }}"
                       class="cabinet__home-link">{{ __('ProfileSetting') }}</a>
                    <div class="cabinet__home-link">
                        @include('cabinet.logout.logout')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

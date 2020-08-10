@extends('layouts.app')
@section('title', __('ProfileSetting'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet">
                <h1>{{ __('ProfileSetting') }}</h1>
                @include('flash.index')
                @include('cabinet.profile._nav')
            </div>
        </div>
    </section>
@endsection

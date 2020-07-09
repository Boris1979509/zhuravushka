@extends('layouts.app')
@section('description', '')
@section('title', __('404'))
@section('content')
    <section id="compare">
        <div class="container">
            <h1>{{ __('404') }}</h1>
            <div class="row">
                <img src="{{ asset('images/404.png') }}" alt="{{ __('404') }}">
            </div>
        </div>
    </section>
@endsection

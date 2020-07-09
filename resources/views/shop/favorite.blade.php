@extends('layouts.app')
@section('description', '')
@section('title', __('Favorite'))
@section('content')
    <section id="favorite">
        <div class="container">
            <h1>{{ __('Favorite') }}</h1>
            <div class="row">
                @include('flash.index')
            </div>
        </div>
    </section>
@endsection

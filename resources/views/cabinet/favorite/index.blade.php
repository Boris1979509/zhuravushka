@extends('layouts.app')
@section('title', __('Favorite'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet">
                <h1>{{ __('Favorite') }}</h1>
                @include('cabinet.components.topSort')
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('title', __('Cabinet'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet">
                <h1>{{ __('Cabinet') }}</h1>
                @include('cabinet.topSort')
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('title', __('CabinetComment'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet">
                <h1>{{ __('CabinetComment') }}</h1>
                @include('cabinet.components.topSort')
            </div>
        </div>
    </section>
@endsection

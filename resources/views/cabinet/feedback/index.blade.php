@extends('layouts.app')
@section('title', __('CabinetFeedBack'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet">
                <h1>{{ __('CabinetFeedBack') }}</h1>
                @include('cabinet.components.topSort')
                @include('cabinet.components.feedback')
            </div>
        </div>
    </section>
@endsection

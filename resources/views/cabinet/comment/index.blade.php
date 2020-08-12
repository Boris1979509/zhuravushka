@extends('layouts.app')
@section('title', __('CabinetComment'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet">
                <h1>{{ __('CabinetComment') }}</h1>
                @include('cabinet.comment._nav')
                @include('flash.index', ['info' => __('NoComments')])
            </div>
        </div>
    </section>
@endsection

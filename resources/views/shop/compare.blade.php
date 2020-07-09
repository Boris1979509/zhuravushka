@extends('layouts.app')
@section('description', '')
@section('title', __('Compare'))
@section('content')
    <section id="compare">
        <div class="container">
            <h1>{{ __('Compare') }}</h1>
            <div class="row">
                @include('flash.index')
            </div>
        </div>
    </section>
@endsection

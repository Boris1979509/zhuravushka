@extends('layouts.app')
@section('title', __('CabinetOrder'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet">
                <h1>{{ __('CabinetOrder') }}</h1>
                @include('flash.index')
                @include('cabinet.order._nav')
                @include('cabinet.order.order')
            </div>
        </div>
    </section>
@endsection


@extends('layouts.app')
@section('description', __(''))
@section('title', __('AdminOrders'))
@section('content')
    <section id="admin">
        <div class="container">
            <div class="admin-orders">
                @include('admin.orders._nav')
                <h1>{{ __('AdminOrders') }}</h1>
                @include('flash.index')
                @include('cabinet.order.order')
            </div>
        </div>
    </section>
@endsection

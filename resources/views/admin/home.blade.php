@extends('layouts.app')
@section('title', __('AdminDashboard'))
@section('content')
    <section id="admin-dashboard">
        <div class="container">
            <div class="admin-dashboard">
                <h1>{{ __('Admin') }}</h1>
                @include('flash.index')
            </div>
        </div>
    </section>
@endsection

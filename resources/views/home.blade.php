@extends('layouts.app')
@section('title', 'Главная')

@section('description', 'Описание')

@section('content')
    <div class="page-top-grid">
        @include('layouts.templates.barMenu')
        <div class="homepage-top-grid__right">
            @include('layouts.templates.homepage-slider')
        </div>
    </div>
@endsection

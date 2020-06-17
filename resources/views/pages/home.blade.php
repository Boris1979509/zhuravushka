@extends('layouts.app')
@section('title', $page->title)

@section('description', $page->description)

@section('content')
    <div class="container">
        <div class="page-top-grid">
            @include('components.barMenu')
            @include('components.homepage-slider')
            @include('components.homepage-top-tabs-category')
        </div>
    </div>
    @include('components.banner')
    @include('components.leaderSales')
@endsection

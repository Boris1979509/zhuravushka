@extends('layouts.app')
@section('title', $page->title)

@section('description', $page->description)

@section('content')
    <div class="container">
        <div class="page-top-grid">
            @include('components.barMenu')
            @include('components.homepage-slider')
        </div>
    </div>
@endsection

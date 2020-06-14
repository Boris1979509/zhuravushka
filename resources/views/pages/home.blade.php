@extends('layouts.app')
@section('title', $page->title)

@section('description', $page->description)

@section('content')
    <div class="container">
        <div class="row">
            <div class="page-top-grid">
                @include('components.barMenu')
                <div class="homepage-top-grid__right">
                    @include('components.homepage-slider')
                </div>
            </div>
        </div>
    </div>
@endsection

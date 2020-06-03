@extends('layouts.app')

@section('title', $page->title)

@section('description', $page->description)

@section('content')
    <div class="container">
        <div class="row">
            <div class="page-top-grid page-content">
                @include('layouts.templates.pageNavMenu')
            </div>
        </div>
    </div>
    @include('pages.' . $page->slug)
    <div hidden>
        @include('layouts.templates.barMenu')
    </div>
@endsection

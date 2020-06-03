@extends('layouts.app')

@section('title', $page->title)

@section('description', $page->description)

@section('content')
    <div class="page-top-grid page-content">
        @include('layouts.templates.pageNavMenu')
        @include('pages.' . $page->slug)
        <div hidden>
            @include('layouts.templates.barMenu')
        </div>
    </div>
@endsection

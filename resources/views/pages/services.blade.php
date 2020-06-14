@extends('layouts.app')

@section('title', $page->title)

@section('description', $page->description)

@section('content')
    @include('components.pageNavMenu')
    <section id="services">
            @include('pages.' . $subPage)
    </section>
@endsection

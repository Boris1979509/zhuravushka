@extends('layouts.app')
@section('title', $page->title)

@section('description', $page->description)

@section('content')
    <div class="container">
        <div class="page-top-grid">
            @include('components.barMenu')
            @include('components.homepage-slider')
            @include('components.glider-carousel')
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        new Glider(document.querySelector('.glider'), {
            itemWidth: 'auto',
            slidesToShow: 4, // auto
            slidesToScroll: 4, // auto

            draggable: true,
            //dots: '.dots',
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            }
        });
    </script>
@endsection

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
{{--    @include('components.leaderSales')--}}
@endsection
@section('scripts')
    <script>
        // const all = document.querySelectorAll('.glider');
        // Array.from(all, (item) => {
        //     new Glider(item, {
        //         //itemWidth: 'auto',
        //         slidesToShow: 4, // auto
        //         slidesToScroll: 4, // auto
        //
        //         draggable: true,
        //         //dots: '.dots',
        //         arrows: {
        //             prev: '.glider-prev',
        //             next: '.glider-next'
        //         }
        //     });
        // });
    </script>
@endsection

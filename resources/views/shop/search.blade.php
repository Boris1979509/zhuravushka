@extends('layouts.app')
@section('description', '')
@section('title', __('Search'))
@section('content')
    <section id="search-wrap">
        <div class="container">
            @if(!empty($products))
                <div class="card-container grid">
                    @include('shop.card')
                    @if($products->total() > $products->count())
                        <div class="paginator-wrap">{{ $products->links() }}</div>
                    @endif
                </div>
            @else
                @include('flash.index', ['info' => __('NotFound')])
            @endif
        </div>
    </section>
@endsection

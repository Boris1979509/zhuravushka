@extends('layouts.app')
@section('description', '')
@section('title', __('Favorite'))
@section('content')
    <section id="favorite">
        <div class="container">
            <div class="favorite">
                <div class="favorite__title"><h1>{{ __('Favorite') }}</h1>
                    @if($products)
                        @include('shop.inc.cardRender')
                    @endif
                </div>
                @if(!$products)
                    @include('flash.index')
                @else
                    @include('shop.inc.favoriteCards')
                @endif
            </div>
        </div>
    </section>
@endsection

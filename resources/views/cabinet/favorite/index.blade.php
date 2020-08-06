@extends('layouts.app')
@section('title', __('Favorite'))
@section('content')
    <section id="cabinet">
        <div class="container">
            <div class="cabinet favorite">
                <h1>{{ __('Favorite') }}</h1>
                @include('cabinet.components.topSort')
                @if($favoriteCount)
                    @include('shop.inc.cardRender')
                @endif
                @if($favoriteCount)
                    <div class="card-container">
                        @include('shop.card')
                    </div>
                @else
                    @include('flash.index', ['info' => __('IsEmptyFavoriteMessage')])
                @endif
            </div>
        </div>
    </section>
@endsection

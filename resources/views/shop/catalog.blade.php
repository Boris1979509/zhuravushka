@extends('layouts.app')
@php /** @var ProductCategory $category */use App\Models\Shop\ProductCategory;@endphp
@section('title', __('Catalog'))
@section('description', __('Catalog'))

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{ __('Catalog') }}</h1>
        </div>
    </div>
@endsection

@extends('layouts.app')
@php /** @var ProductCategory $category */use App\Models\Shop\ProductCategory;@endphp
@section('title', $category->title)
@section('description', $category->description)

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{ $category->title }}</h1>
        </div>
    </div>
@endsection

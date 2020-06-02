@extends('layouts.app')

@section('title', $page->title)

@section('description', $page->description)

@section('content')
  <h1>{{ $page->title }}</h1>
@endsection

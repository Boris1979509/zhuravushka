@extends('layouts.app')

{{--@section('title', $page->title)--}}

{{--@section('description', $page->description)--}}
@section('content')
    <div class="container page-content about-company-wrap">
        {{--<h1 class="title">{{ $page->title }}</h1>--}}
        <div class="row">
            <div class="blog">
                @php /** @var BlogPost $post */use App\Models\Blog\BlogPost; @endphp
                @foreach($paginator as $post)
                    <div class="blog__item">
                        <div class="published">{{ $post->getPublishedAtAttribute($post->published_at) }}</div>
                        <a href="" class="blog__title" title="{{ $post->title }}">
                            {{ $post->title }}
                        </a>
                        <a href="" class="blog__item-img" title="{{ $post->title }}">
                            <img src="{{ asset('images/blog-image.jpg') }}" alt="{{ $post->title }}"
                                 class="blog__item-image">
                        </a>
                        <div class="blog__content">
                            <p class="blog__text" title="{{ $post->excerpt }}">
                                {{ $post->excerpt }}
                            </p>
                        </div>
                        <a href="" class="blog__link">Читать полностью</a>
                    </div>
                @endforeach
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <div class="paginator-wrap">{{ $paginator->links() }}</div>
        @endif
    </div>
@endsection

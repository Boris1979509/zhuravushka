@extends('layouts.app')

@section('title', $page->title)

@section('description', $page->description)
@section('content')
    <div class="container">
        <h1 class="blog-title">{{ $page->title }}</h1>
        <div class="blog-wrap">
            @include('blog.blog-categories-sideBar')
            <div class="blog">
                @php /** @var BlogPost $post */use App\Models\Blog\BlogPost; @endphp
                @foreach($paginator as $post)
                    <div class="blog__item">
                        <div class="blog__image">
                            <a href="{{ route('blog.post', $post->slug) }}" title="{{ $post->title }}">
                                <img src="{{ asset('images/blog-image.jpg') }}" alt="{{ $post->title }}"
                                     class="blog__item-image">
                            </a>
                        </div>
                        <div class="blog__body">
                            <p class="published">{{ $post->date_format }}</p>
                            <a href="{{ route('blog.post', $post->slug) }}" class="link blog__title-link" title="{{ $post->title }}">
                                {{ $post->title }}
                            </a>
                            <div class="blog__content">
                                <p title="{{ $post->limit_content }}">
                                    {{ $post->limit_content }}
                                </p>
                                {{--{{ $post->category->title }}--}}
                            </div>
                            <a href="{{ route('blog.post', $post->slug) }}" class="link blog__link">Читать полностью</a>
                        </div>
                    </div>
                @endforeach
                @if($paginator->total() > $paginator->count())
                    <div class="paginator-wrap">{{ $paginator->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('description', __(''))
@section('title', __(''))
@section('content')
    <section id="admin">
        <div class="container">
            <div class="admin-posts">
                @include('admin.blog.posts._nav')
                <h1>{{ __('Posts') }}</h1>
                <div class="grid">
                    <a href="{{ route('admin.blog.posts.create') }}"
                       class="btn btn-go-on btn-outline">{{ __('Add post') }}</a>
                    <a href="{{ route('admin.blog.categories.index') }}"
                       class="btn btn-outline">{{ __('Categories') }}</a>
                </div>
                <table class="table mt-1">
                    <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Date published') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php /** @var BlogPost $post */use App\Models\Blog\BlogPost; @endphp
                    @foreach ($posts as $post)
                        <tr @if(!$post->is_published) class="active" @endif>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->category->title }}</td>
                            <td>@if(is_null($post->deleted_at))
                                    <a href="{{ route('admin.blog.posts.edit', $post) }}"
                                       class="link edit">{{ $post->title }}</a>
                                @else
                                    {{ $post->title }}
                                    <div class="">
                                        {{ __('Article is deleted') }}
                                        <a href="{{ route('admin.blog.posts.restore', $post) }}">{{ __('Restore') }}</a>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $post->published_at ? parseDate(carbon($post->published_at))->format('j F, Y') : null }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if($posts->total() > $posts->count())
                    <div class="paginator-wrap">{{ $posts->links() }}</div>
                @endif
            </div>
        </div>
    </section>
@endsection

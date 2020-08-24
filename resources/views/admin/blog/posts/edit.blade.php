@extends('layouts.app')
@section('description', __(''))
@section('title', __(''))
@section('content')
    <section id="admin">
        <div class="container">
            <div class="admin-posts">
                @include('admin.blog.posts._nav')
                <h1>{{ __('Create') }}</h1>
                @php /** @var App\Models\Blog\BlogPost $item */@endphp
                <form action="{{ route('admin.blog.posts.update', $item->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="post-wrap">
                        <div class="post-content">
                            @include('admin.blog.posts.includes.item_edit_main_col')
                        </div>
                        <div class="post-info">
                            @include('admin.blog.posts.includes.item_edit_add_col')
                        </div>
                    </div>
                </form>
                {{-- DELETE --}}
                <form action="{{ route('admin.blog.posts.destroy', $item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="">
                        <button type="submit" class="btn btn-cancel btn-outline">{{ __('Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

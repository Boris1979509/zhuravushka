@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
    <section id="admin">
        <div class="container">
            <div class="admin">
                <h1>{{ __('Dashboard') }}</h1>
                @include('flash.index')
                <div class="admin__home">
                    <a href="{{ route('admin.users.index') }}"
                       class="admin__home-link">{{ __('Users') }}<span class="count">{{ $users }}</span></a>
                    <a href="{{ route('admin.blog.posts.index') }}"
                       class="admin__home-link">{{ __('Blog') }}<span class="count">{{ $posts }}</span></a>
                    <div class="admin__home-link">
                        @include('cabinet.logout.logout')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

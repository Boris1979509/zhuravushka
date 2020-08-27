@extends('layouts.app')
@section('description', __(''))
@section('title', __('Orders'))
@section('content')
    <section id="admin">
        <div class="container">
            <div class="admin-orders">
                @include('admin.orders._nav')
                <h1>{{ __('Posts') }}</h1>
                @include('flash.index')
                <div class="grid">
                    {{--                    <a href="{{ route('admin.blog.posts.create') }}"--}}
                    {{--                       class="btn btn-go-on btn-outline">{{ __('Add post') }}</a>--}}
                    {{--                    <a href="{{ route('admin.blog.categories.index') }}"--}}
                    {{--                       class="btn btn-outline">{{ __('Categories') }}</a>--}}
                </div>
                @php /** @var Order $orderItem */use App\Models\Shop\Order; @endphp
                @if($orders->count())
                    @dump($orders)
                    <table class="table mt-1">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Date created') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $orderItem)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ parseDate(carbon($orderItem->created_at))->format('j F, Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($orders->total() > $orders->count())
                        <div class="paginator-wrap">{{ $orders->links() }}</div>
                    @endif
                @endif
            </div>
        </div>
    </section>
@endsection

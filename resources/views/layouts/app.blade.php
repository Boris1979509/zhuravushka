<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content=""/>
    <!-- Style -->
    <link rel="stylesheet" href="{{ mix('css/app.css', 'build') }}">
</head>
<body>
@include('components.header')

@if(url()->current() != url('/'))
    @php /** @var Breadcrumbs */ @endphp
    <div class="container">
        <div class="row">
            {{ Breadcrumbs::render() }}
        </div>
    </div>
@endif
<div class="flex-center position-ref full-height">
    @yield('content')
</div>
@include('components.footer')
<script src="{{ asset('plugins/glider.min.js') }}"></script>
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>

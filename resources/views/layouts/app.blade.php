<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- Style -->
    <link rel="stylesheet" href="{{ mix('css/app.css', 'build') }}">
</head>
<body>
@include('layouts.templates.header')
<div class="flex-center position-ref full-height">
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>
@include('layouts.templates.footer')
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>

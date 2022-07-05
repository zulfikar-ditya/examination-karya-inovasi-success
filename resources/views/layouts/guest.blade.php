<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#06b6d4">
    <meta name="description" content="">
    <meta name="author" content="Zulfikar ditya">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')| karya Inovasi Success</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body class="bg-slate-50">
    @include('layouts.sub_layouts.nav-guest')

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    @stack('script')
</body>
</html>
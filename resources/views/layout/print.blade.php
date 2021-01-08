<html>
    <head>
        <title>App - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/paper.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    @yield('content')
</html>
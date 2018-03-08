<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    <title>@yield('title')</title>
</head>
    <body>
        <div class="container mt-2">
            @include('layouts.nav')
            @yield('body')
        </div>
    </body>
</html>

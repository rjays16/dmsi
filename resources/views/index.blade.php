<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" amp>
<head>
    <link rel="canonical" href="{{ config('app.url') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Virtual Media Events</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="http://dms-frontend.local/js/app.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="http://dms-frontend.local/asset/css/app.css" rel="stylesheet"> -->

</head>
<body>
	<div id="app-container">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
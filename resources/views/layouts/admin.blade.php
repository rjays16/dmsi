<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" amp>
<head>
    <link rel="canonical" href="{{ config('app.url') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Virtual Media Events CMS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/appAdmin.js') }}" defer></script>
    <!-- <script src="http://dms-frontend.local/js/appAdmin.js" defer></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="http://dms-frontend.local/asset/css/app.css" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">    
 
</head>
<body>
	<div id="app-container">
        <main class="skin-dark">
            
            @yield('content')
        </main>
    </div>
</body>
</html>

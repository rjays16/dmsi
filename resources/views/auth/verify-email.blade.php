<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" amp>
<head>
    <link rel="canonical" href="{{ config('app.url') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Verify Email</title>

    <!-- Scripts -->
    <script src="js/app.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
 
</head>
<body>
    <div id="app-container">
        <div class="container text-center">
            <h6>A verification link has been sent to your email</h6>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="Post" action="/email/verification-notification">
                    @csrf
                    <div class="form-group">
                        <label for="col-form-label text-md-right">E-mail Address</label>
                        <input type="text" class="form-control" autocomplete="email" autofocus name="email">
                    </div>
                    <button class="btn btn-primary">Resend Email Verification Link</button>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>

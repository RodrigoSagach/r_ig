<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="Victor A.">

    <title>@yield('title'){{ array_key_exists('title', View::getSections()) ? ' - ' : '' }}InvestGroup</title>

    <!-- Fonts -->
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500" rel="stylesheet">
    <link type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">

    <!-- <link rel="stylesheet" href="{{ asset('css/vendor-user.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('css/user.css') }}" />

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/vendor-user.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/user-app.js') }}"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.png">
</head>

<body class="focused-form animated-content">
@yield('content')
</body>
</html>

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

<body class="animated-content infobar-overlay">
    <header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="logo-area">
            <a class="navbar-brand navbar-brand-primary" href="{{ url('/') }}">
                <img class="show-on-collapse img-logo-white" alt="Paper" src="assets/img/logo-icon-white.png">
                <img class="show-on-collapse img-logo-dark" alt="Paper" src="assets/img/logo-icon-dark.png">
                <img class="img-white" alt="Paper" src="assets/img/logo-white.png">
                <img class="img-dark" alt="Paper" src="assets/img/logo-dark.png">
            </a>
            <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg stay-on-search">
                <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
                    <span class="icon-bg">
                        <i class="material-icons">menu</i>
                    </span>
                </a>
            </span>
        </div><!-- logo-area -->

        <ul class="nav navbar-nav toolbar pull-right">
        </ul>
    </header>
    <div id="wrapper">
        <div id="layout-static">
            <div class="static-sidebar-wrapper sidebar-blue">
                <div class="static-sidebar">
                    <div class="sidebar">
                        <div class="widget" id="widget-profileinfo">
                            <div class="widget-body">
                                <div class="userinfo ">
                                    <div class="avatar pull-left">
                                        <img src="{{ $user->profile_picture_url }}" class="img-responsive img-circle"> 
                                    </div>
                                    <div class="info">
                                        <span class="username">{{ $user->name }}</span>
                                        <span class="useremail">{{ $user->email }}</span>
                                    </div>

                                    <div class="acct-dropdown clearfix dropdown">
                                        <span class="pull-left"><span class="online-status online"></span>Online</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget stay-on-collapse" id="widget-sidebar">
                            <nav role="navigation" class="widget-body">
                                <ul class="acc-menu">
                                    <li class="nav-separator">
                                        <span>Navigation</span>
                                    </li>
                                    <li>
                                        <a class="withripple" href="/">
                                            <span class="icon"><i class="material-icons">home</i></span><span>Home</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="withripple" href="javascript:;">
                                            <span class="icon"><i class="material-icons">flash_on</i></span><span>Finance</span>
                                        </a>
                                        <ul class="acc-menu">
                                            <li><a class="withripple" href="{{ url('/investments/requests') }}">Pending Invesmetns</a></li>
                                            <li><a class="withripple" href="{{ url('/withdrawals/requests') }}">Pending Withdrawals</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="withripple" href="/excerpts">
                                            <span class="icon"><i class="material-icons">list</i></span><span>Transaction History</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="withripple" href="/users">
                                            <span class="icon"><i class="material-icons">contacts</i></span><span>Users</span>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="/logout" method="post">
                                            {!! csrf_field() !!}
                                        </form>
                                        <a  class="withripple" href="/logout" onclick="$(this).prev('form').submit(); return false;">
                                            <span class="icon"><i class="material-icons">power_settings_new</i></span><span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="static-content-wrapper">
                <div class="static-content">
                    <div class="page-content">
                        <ol class="breadcrumb">                   
                            <li class="">
                                <a href="/">Home</a>
                            </li>
                        @yield('breadcrumb')
                        </ol>
                    @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

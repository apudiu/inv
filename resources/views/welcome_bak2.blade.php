<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS  -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="navbar-fixed">
    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="#" class="brand-logo text-capitalize">
                {{ config('app.name') }}
            </a>

            <!-- Full width menu -->
            <ul class="right hide-on-med-and-down">
                <li><a href="#">Invoices</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Estimates</a></li>
                <li><a href="#">Recurrings</a></li>
                <li><a href="#">Clients</a></li>
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="menu-user">
                        User Name<i class="material-icons right">arrow_drop_down</i>
                    </a>
                    <ul id="menu-user" class="dropdown-content">
                        <li><a href="#!">Profile</a></li>
                        <li><a href="#!">Setting</a></li>
                        <li class="divider"></li>
                        <li><a href="#!">LogOut</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Mobile menu -->
            <ul id="nav-mobile" class="sidenav">
                <li><a href="#">Invoices</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Estimates</a></li>
                <li><a href="#">Recurrings</a></li>
                <li><a href="#">Clients</a></li>
                <li>
                    <a class="dropdown-trigger" href="#!" data-target="menu-user-m">
                        User Name<i class="material-icons right">arrow_drop_down</i>
                    </a>
                    <ul id="menu-user-m" class="dropdown-content">
                        <li><a href="#!">Profile</a></li>
                        <li><a href="#!">Setting</a></li>
                        <li class="divider"></li>
                        <li><a href="#!">LogOut</a></li>
                    </ul>
                </li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>
        </div>
    </nav>

</div>

<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">Starter Template</h1>
        <div class="row center">
            <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
        </div>
        <div class="row center">
            <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
        </div>
        <br><br>

    </div>
</div>


<div class="container">
    <div class="section">

        <!--   Icon Section   -->
        <div class="row">
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
                    <h5 class="center">Speeds up development</h5>

                    <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
                    <h5 class="center">User Experience Focused</h5>

                    <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
                    <h5 class="center">Easy to work with</h5>

                    <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
                </div>
            </div>
        </div>

    </div>
    <br><br>
</div>

<footer class="page-footer teal p-0">
    <div class="footer-copyright">
        <div class="container">
            This is <a class="orange-text text-lighten-3" href="/">INV</a>
        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>

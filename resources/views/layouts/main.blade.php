<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- CSS  -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('onpage-css')
</head>
<body>

<!-- Nav -->
@include('layouts.partials._nav')

<!-- Content -->
<div class="container">

    @yield('content')
    {{--Start with section > row > col--}}
    {{--<div class="section">--}}
        {{--<div class="row">--}}
            {{--<div class="col s12 m4"></div>--}}
            {{--<div class="col s12 m4"></div>--}}
        {{--</div>--}}
    {{--</div>--}}

</div>

<!-- Footer -->
@include('layouts.partials._foot')

<!-- nt -->
<div id="noti-container" class="hiddendiv">
</div>

<!--  Scripts-->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Notification -->
<script>

        @if(($nt=getFromSession('notification')))

            let clss = {
                'success': 'light-green darken-3',
                'error' : 'deep-orange darken-3',
                'info' : 'blue-grey'
            };

            M.toast({
                html : '<div class="notification"><div class="title font-weight-bold">{{ $nt['title'] ?? "" }}</div><div>{{ $nt['body'] ?? "" }}</div></div>',
                classes : clss.{{ $nt['type'] ?? 'info' }}
            });
        @endif
</script>
@yield('onpage-js')


</body>
</html>

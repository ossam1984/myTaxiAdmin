<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @yield('top-ext')

</head>
<body>

<div id="navbar">
    @include('partials.nav')
</div>

    <!-- sidebar content -->
<div id="sidebar" class="col-md-2">
        @include('partials.sidebar')
</div>

    <!-- main content -->
    <div id="content" class="col-md-offset-2 col-md-10">

            @yield('content')


    </div>



    <div id="footer" class="col-md-offset-2 col-md-10">
        @include('partials.footer')
    </div>


</div>


<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
@yield('bottom-ext')

</body>
</html>
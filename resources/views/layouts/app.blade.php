<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}"/>

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    {!! Html::style('css/lightslider.css') !!}
    {!! Html::style('css/photoswipe.css') !!}
    {!! Html::style('css/lity.css') !!}
    {!! Html::style('css/default-skin/default-skin.css') !!}

    <style>
        body {
            font-family: 'Lato';
            background-color: #e4e4e4;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Lara-Screenshot
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <!-- <li><a href="{{ url('/blogs') }}">Blogs</a></li> -->
                </ul>

                <!-- Right Side Of Navbar -->
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>


    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {!! Html::script('js/lightslider.js') !!}
    {!! Html::script('js/photoswipe.js') !!}
    {!! Html::script('js/photoswipe-ui-default.js') !!}
    {!! Html::script('js/lity.js') !!}
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('scripts')
</body>
</html>

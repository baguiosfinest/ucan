<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" />
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 24px;
                line-height: normal;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                
            }
            .links > a:hover {
                color: #fff;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="welcome-body">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        @if(Auth::user()->is_admin == 1)
                            <a href="{{ url('/dashboard/index') }}">Admin</a>
                        @else
                            <a href="{{ url('/home') }}">Home</a>
                        @endif
                        
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content main-content">

                <div class="content-left">
                    <h1 class="logo"><a href="/"><img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" /></a></h1>
                    <div class="image">
                        <img src="{{ asset('img/ucan_bagdrop.png') }}" alt="">
                    </div>
                    <div class="title m-b-md">
                        {!! config('app.desc', 'UCanRecycleWA') !!}
                    </div>
                    <div class="buttons">
                        <a href="/login" class="btn btn-primary">Login</a>
                        <a href="/register" class="btn btn-primary">Register</a>
                    </div>
                </div>
                <div class="content-right" style="background-image: url({{ asset('img/undraw_metrics_gtu7.svg') }});">

                </div>

            </div>
        </div>
    </body>
</html>

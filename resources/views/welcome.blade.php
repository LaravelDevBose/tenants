<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .backGround{
                background: url({{asset('public/assets/images/main_cover.jpg')}});
                /* Full height */
                height: 100%;
                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
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
                font-size: 84px;
                font-weight: 800;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links > a:hover {
                color: #009688;
                text-decoration: snow;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .find_me{
                font-size: 25px;
                font-weight: 800;
                color: orangered;
            }

        </style>
    </head>
    <body class="backGround">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a style="color: #ffffff; font-weight: 800" href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md ">
                    Tenant Management System
                </div>

                <div class="links">
                    <p class="find_me">Find Me On</p>
                    <a href="https://www.facebook.com/aajob.arup" target="_blank">Facebook</a>
                    {{--<a href="https://laracasts.com" target="_blank">LinkedIn</a>--}}
                    <a href="https://www.fiverr.com/devbose" target="_blank">Fiver</a>
                    <a href="mail:arupkumerbose@gmail.com">Mail</a>
                    <a href="https://github.com/LaravelDevBose" target="_blank">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>

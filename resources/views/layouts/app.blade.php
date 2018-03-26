<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/')}}/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/')}}/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/')}}/css/core.css" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/')}}/css/components.css" rel="stylesheet" type="text/css">
    <link href="{{asset('public/assets/')}}/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{asset('public/assets/')}}/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="{{asset('public/assets/')}}/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('public/assets/')}}/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('public/assets/')}}/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    @yield('assets')


</head>

<body class="{{ (Route::currentRouteName() == 'tenants.show') ?'sidebar-xs has-detached-left' : ' ' }}">

<!-- Main navbar -->
@include('includes.navbar')
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        @include('includes.sidebar')
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Dashboard content -->
                @yield('content')
                <!-- /dashboard content -->

                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>

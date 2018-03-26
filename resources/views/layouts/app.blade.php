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
<!-- Info modal -->
<div id="user_rating_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Suggestion or Question</h6>
            </div>
            <form action="{{ route('rating.store') }}" method="POST">{{csrf_field()}}
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p><span class="text-bold text-info-700"> Sir ! Fill Free to Suggestion me to Build Up More User friendly System. And Ask Me Any Question Related this.</span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" name="name" required class="form-control" placeholder="Ex:Arup Bose">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Or Phone Number:</label>
                                <input type="text" name="email" required class="form-control" placeholder="Enter Your Email Or Phone Number">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Your Suggestion Or Question :</label>
                                <textarea name="message"   rows="5" class="form-control" data-placeholder="Your Suggestion Or Question"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info paid">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /info modal -->
</body>
</html>

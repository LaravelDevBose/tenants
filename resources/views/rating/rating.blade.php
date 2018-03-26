@extends('layouts.app')

@section('title','Single User Rating')

@section('assets')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jquery_ui/widgets.min.js')}}"></script>


    <script type="text/javascript" src="{{asset('public/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/form_layouts.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel ">
                <div class="panel-heading bg-success-400">
                    <h5 class="panel-title">User Suggestion And Question</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class=" col-md-12">
                            <label>Name: <span class="text-bold">{{ $rating->name }}</span></label>
                        </div>
                        <div class="col-md-12">
                            <label>Email Or Phone: <span class="text-bold">{{ $rating->email }}</span></label>
                            <hr>
                        </div>
                        <div class=" col-md-12">
                            <label class="display-block text-bold">Suggestion Or Question:</label>
                            <p style="border:1px solid #ddd; padding: 15px;">{!! $rating->message !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
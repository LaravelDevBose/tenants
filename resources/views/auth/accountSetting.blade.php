@extends('layouts.app')

@section('title','Account Setting')
@section('assets')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/uploaders/fileinput/fileinput.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/uploader_bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 ">
            <div class="panel ">
                <div class="panel-heading bg-teal-600">Profile Image Change</div>

                <div class="panel-body">

                    <form action="{{ route('image.change') }}" method="POST" enctype='multipart/form-data' >{{ csrf_field() }}
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <div class="col-md-12" style="margin-bottom: 15px" >
                                <input type="file" name="image" class="file-input" accept="image/*" data-browse-class="btn btn-primary btn-block" data-show-remove="false" data-show-caption="false" data-show-upload="false">
                            </div>
                            @if ($errors->has('image'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                            @endif
                            <div class="col-md-12 ">
                                <button type="submit" class="btn btn-success btn-block">
                                    Change Image
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2 ">
            <div class="panel ">
                <div class="panel-heading bg-blue-400">
                    <h5 class="text-semibold" style=" margin: 0; padding: 0;">Account Password Change</h5>

                    @if ($errors->has('warning'))
                        <span class="help-block">
                            <strong>{{ $errors->first('warning') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.change') }}"> {{ csrf_field() }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="col-md-4 control-label">Current Password:</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" value="{{ old('current_password') }}" required autofocus>

                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title','View Tenants')

@section('assets')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery_ui/widgets.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/notifications/sweet_alert.min.js')}}"></script>


    <script type="text/javascript" src="{{asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/form_layouts.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/jqueryui_forms.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel  ">
                    <div class="panel-heading bg-primary">
                        <h5 class="panel-title">Expense Insert Form</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        @include('includes.message')
                        <form action="{{ route('report.download') }}" name="expenses_insert" method="POST">{{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>File Name: <span class="text-bold text-danger">*</span></label>
                                    <input type="text" name="file_name" value="{{ old('file_name') }}" maxlength="80" class="form-control" placeholder="Enter Your Expense Title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Payment Type: <span class="text-bold text-danger">*</span></label>
                                    <select class="select" name="report_for" required>
                                        <optgroup label="Select Your Payment Type">
                                            <option value="1">Tenant</option>
                                            <option value="2">Payment</option>
                                            <option value="3">Expense</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="display-block">Date From:</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        <input type="text" name="date_from" value="{{ old('date_from') }}" class="form-control datepicker" placeholder="Pick a date&hellip;">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="display-block"> Date To:</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        <input type="text" name="date_to" value="{{ old('date_to') }}" class="form-control datepicker" placeholder="Pick a date&hellip;">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>File Type: <span class="text-bold text-danger">*</span></label>
                                    <select class="select" name="file_type" required >
                                        <optgroup label="Select A Expense Type">
                                            <option value="xls">Excel xls</option>
                                            <option value="xlsx">Excel xlsx</option>
                                            <option value="csv">CSV</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="text-right col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
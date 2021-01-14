@extends('layouts.app')

@section('title','Expense Insert Form')

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
            <!-- Expanses insert Form-->
            <div class="col-md-8 ">
                <div class="panel ">
                    <div class="panel-heading bg-success-400">
                        <h5 class="panel-title">Expense Insert Form</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        @include('includes.message')
                        <form action="{{ route('expenses.store') }}" name="expenses_insert" method="POST">{{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Title:</label>
                                    <input type="text" name="title" value="{{ old('title') }}" maxlength="80" class="form-control" placeholder="Enter Your Expense Title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Expense Type:</label>
                                    <select class="select" name="expenses_type" id="expenses_type">
                                        <optgroup label="Select A Expense Type">
                                            @foreach($expenseTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="display-block">Expense Date:</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                        <input type="text" name="date" value="{{ old('date') }}" class="form-control datepicker" placeholder="Pick a date&hellip;">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Amount:</label>
                                    <input type="number" name="amount" value="{{ old('amount') }}" class="form-control" placeholder="Expense Amount">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Payment Type:</label>
                                    <select class="select" name="payment_type">
                                        <optgroup label="Select Your Payment Type">
                                            <option value="Cash">Cash</option>
                                            <option value="Card">Card</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Expense Status:</label>
                                    <select class="select" name="status">
                                        <optgroup label="Select A Expense Status">
                                            <option value="1">Paid</option>
                                            <option value="0">Hold</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Sort Note:</label>
                                    <textarea rows="2"  name="short_note" class="form-control" maxlength="150" placeholder="Give A Short Note in 150 Character">{{ old('short_note') }}</textarea>
                                </div>
                                <div class="text-right col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /Expanses  insert Form -->
            <!-- Expanses Type insert Form -->
            <div class="col-md-4">
                <div class="panel ">
                    <div class="panel-heading bg-blue-300">
                        <h5 class="panel-title">Expense Type Insert</h5>

                    </div>
                    <div class="modal-body">
                        <div class="row" id="expense_type_insert">
                            <div class="form-group col-md-12">
                                <label>Title:</label>
                                <input type="text" name="title" maxlength="40" class="form-control" placeholder="Enter Your Expense Title in 40 Character">
                            </div>
                            <button type="button" class="btn btn-success btn-sm pull-right" id="insert">Save</button>
                        </div>
                    </div>

                    <div class="panel-body border-top-warning">
                        <table class="table table-bordered ">
                            <thead>
                            <tr>
                                <th style="width: 5px;">SL No.</th>
                                <th>Expenses Title</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="type_view">
                                @foreach($expenseTypes as $type)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $type->title }}</td>
                                    <td class="text-center">
                                        <ul id="{{ $type->id }}" class="icons-list">
                                            <li class="text-primary-600"><a href="#" data-toggle="modal" data-target="#modal_type" class="edit"><i class="icon-pencil7"></i></a></li>
                                            <li class="text-danger-600"><a href="#" class="delete_type"><i class="icon-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/Expanses Type insert Form -->
        </div>
    </div>
    <div id="modal_type" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Update</h6>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title:</label>
                                <input type="text" name="title" required class="form-control" placeholder="Title">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info jh " id="update">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/ajax/expenses.js') }}"></script>
    <script>
        document.forms['expenses_insert'].elements['expenses_type'].value={{ old('expenses_type') }}
        document.forms['expenses_insert'].elements['payment_type'].value={{ old('payment_type') }}
        document.forms['expenses_insert'].elements['status'].value={{ old('status') }}

    </script>
@endsection
@extends('layouts.app')

@section('title','View Expense Info')

@section('assets')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jquery_ui/widgets.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/notifications/sweet_alert.min.js')}}"></script>


    <script type="text/javascript" src="{{asset('public/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/datatables_advanced.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/jqueryui_forms.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!-- Highlighting rows and columns -->
            <div class="panel ">
                <div class="panel-heading bg-teal-400">
                    <h5 class="panel-title">Expenses Information</h5>

                </div>

                <div class="panel-body">
                    @include('includes.message')

                    <div class="row">
                        <div class="col-md-10">
                            <div class="content-group-lg" >
                                <form action="{{ route('expenses.search') }}" method="POST">{{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h6 class="text text-semibold text-info">Search By Date :</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="date_from" class="form-control datepicker"  placeholder="Date from:">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="date_to" class="form-control datepicker"  placeholder="Date to:">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" id="search" class="btn btn-sm btn-success btn-block"> Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <a href="{{ route('expenses.create') }}" class="btn btn-sm btn-info pull-right" >Add New Expense</a>
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-hover datatable-highlight">
                    <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Expenses Title</th>
                        <th>Expenses Type</th>
                        <th >Date</th>
                        <th>Amount</th>
                        <th>Payment Type</th>
                        <th>Short-Note</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $expense->title }}</td>
                        <td>{{ $expense->expenseType->title }}</td>
                            <?php
                            $date = new DateTime($expense->date);
                            $expense_date = date_format($date, 'd-M-y');

                            ?>
                        <td>{{ $expense_date }}</td>
                        <td>${{ $expense->amount }}</td>
                        <td>{{ $expense->short_note }}</td>
                        <td>{{ $expense->payment_type }}</td>
                        <td>
                            @if($expense->status == 1)
                            <span class="label label-success">Paid</span>
                            @else
                                <span class="label label-warning">Hold</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="text-primary-600"><a href="{{ route('expenses.edit',$expense->id) }}"><i class="icon-pencil7"></i></a></li>
                                <li class="text-danger-600" id="{{ $expense->id }}"><a href="#" class="delete_expense"><i class="icon-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /highlighting rows and columns -->

        </div>
    </div>
    <script src="{{ asset('public/assets/ajax/expenses.js') }}"></script>
@endsection
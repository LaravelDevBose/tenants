@extends('layouts.app')

@section('title','Dashboard')

@section('assetsfile')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>


    <script type="text/javascript" src="{{asset('public/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/datatables_advanced.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
    {!! Charts::styles() !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="panel panel-body bg-blue-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin">{{ number_format($tenants_count) }}</h3>
                                <span class="text-uppercase text-size-mini">total tenants</span>
                            </div>

                            <div class="media-right media-middle">
                                <i class="icon-users4 icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="panel panel-body bg-danger-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin">${{ number_format($total_expense) }}</h3>
                                <span class="text-uppercase text-size-mini">Total expenses</span>
                            </div>

                            <div class="media-right media-middle">
                                <i class="icon-cash3 icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="panel panel-body bg-success-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-left media-middle">
                                <i class="icon-piggy-bank icon-3x opacity-75"></i>
                            </div>

                            <div class="media-body text-right">
                                <h3 class="no-margin">${{ number_format($total_income) }}</h3>
                                <span class="text-uppercase text-size-mini">Total Income</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="panel panel-body bg-indigo-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-left media-middle">
                                <i class="icon-calculator3 icon-3x opacity-75"></i>
                            </div>

                            <div class="media-body text-right">
                                <h3 class="no-margin">${{ number_format($total_payment-$total_income) }}</h3>
                                <span class="text-uppercase text-size-mini">total Due</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12  col-md-12">

                    @include('includes.message')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12  col-md-12">
                    <div class="panel ">
                        <div class="panel-heading bg-indigo-400">
                            <h5 class="panel-title">Monthly Income Expense Chart</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="chart-container">
                                {!! $chart->html() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12  col-md-12">
                    <div class="panel">
                        <div class="panel-heading bg-purple-400">
                            <h5 class="panel-title">View All Tenants Infomarion</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a href="{{ route('expenses.index') }}" class="btn btn-sm btn-info" style="color: #fff;">Full View</a></li>
                                </ul>
                            </div>
                        </div>

                        <table class="table table-bordered table-hover datatable-highlight">
                            <thead>
                            <tr>
                                <th>Tenant Info</th>
                                <th>Balance</th>
                                <th>Total</th>
                                <th>Paid Amount</th>
                                <th>Amount Payable</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($current_month_payment as $payment)
                                <tr >
                                    <td>
                                        <div class="media-left media-middle">
                                            <?php $image = $payment->tenant->image; if(!file_exists($image)) { $image = 'public/assets/images/placeholder.jpg' ;}?>
                                            <a href="{{ route('tenants.show', $payment->tenant_id) }}"><img src="{{asset($image)}}" class="img-circle img-xs" alt="{{ $payment->tenant->full_name }}"></a>
                                        </div>
                                        <div class="media-left">
                                            <div class=""><a href="{{ route('tenants.show', $payment->tenant_id) }}" class="text-default name text-semibold">{{ $payment->tenant->full_name }}</a></div>
                                            <div class="text-muted text-size-small">
                                                Id:-{{ $payment->tenant->id_number }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($payment->tenant->balance) }}</td>
                                    <td>${{ number_format($payment->total_amount) }}</td>
                                    <?php $date = new DateTime($payment->created_at); $month = date_format($date,'m'); $year = date_format($date, 'Y');?>
                                    <td>${{ number_format($payment->paid_amount($month, $year)) }}</td>
                                    <td>${{ number_format($payment->tenant->payable_amount) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <!-- Marketing campaigns -->

            <!-- /marketing campaigns -->
        </div>
    </div>
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
@endsection
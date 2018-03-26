@extends('layouts.app')

@section('title','View Tenants')

@section('assets')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/notifications/sweet_alert.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/datatables_sorting.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/datatables_extension_colvis.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/form_layouts.js')}}"></script>


    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel ">
                <div class="panel-heading bg-teal-400">
                    <h5 class="panel-title">View All Tenants Infomarion</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a href="{{ route('tenants.create') }}" class="btn btn-sm bg-success-600" style="color: #fff;">All New Tenant</a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    @include('includes.message')
                </div>

                <table class="table table-bordered datatable-colvis-state">
                    <thead>
                    <tr>
                        <th rowspan="2">Name</th>
                        <th colspan="6">Balance And Bill Information</th>
                        <th colspan="3">Total & Payable Amount</th>
                        <th rowspan="2">Action</th>

                    </tr>
                    <tr>
                        <th>Balance</th>
                        <th>Rent Amount</th>
                        <th>Gas Bill</th>
                        <th>Water Bill</th>
                        <th>Net Bill</th>
                        <th>Other Bill</th>
                        <th>Total</th>
                        <th>Paid Amount</th>
                        <th>Amount Payable</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr >
                            <td id="{{ $payment->tenant_id }}">
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
                            <td>${{ number_format($payment->rent_amount) }}</td>
                            <td>${{ number_format($payment->gas_bill) }}</td>
                            <td>${{ number_format($payment->water_bill) }}</td>
                            <td>${{ number_format($payment->net_bill) }}</td>
                            <td>${{ number_format($payment->other_bill) }}</td>
                            <td>${{ number_format($payment->total_amount) }}</td>
                                <?php $date = new DateTime($payment->created_at); $month = date_format($date,'m'); $year = date_format($date, 'Y');?>
                            <td id="{{ $payment->paid_amount($month, $year) }}">${{ number_format($payment->paid_amount($month, $year)) }}</td>
                            <td id="{{$payment->tenant->payable_amount}}">${{ number_format($payment->tenant->payable_amount) }}</td>
                            <td class="text-center">
                                <ul id="{{ $payment->id }}" class="icons-list">
                                    <li class="text-success-600"><a href="#" data-toggle="modal" class="payment" data-target="#modal_payment"><i class="icon-cash3"></i></a></li>
                                    <li class="text-teal-600"><a href="#"><i class="icon-file-download2"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Info modal -->
    <div id="modal_payment" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Info header</h6>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name: <span class="text-bold tenant_name"></span></label>
                        </div>
                        <div class="col-md-6">
                            <label>Payable Amount: <span class="text-bold payable_amount"></span></label>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Payment Amount:</label>
                                <input type="text" name="amount" required class="form-control" placeholder="Payment Amount">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Payment Type:</label>
                                <select class="select" required name="payment_type">
                                    <option value="Card">Card</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="form-group">
                                <label>Payment Date:</label>
                                {{--<span class="input-group-addon"><i class="icon-calendar"></i></span>--}}
                                <input type="date" required name="payment_date" class="form-control datepicker" placeholder="Pick a date&hellip;">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info paid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /info modal -->
    <script src="{{ asset('public/assets/ajax/payment.js') }}"></script>
@endsection


@extends('layouts.app')

@section('title',$tenant->full_name.'-Information')

@section('assets')
    <script type="text/javascript" src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/datatables_advanced.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/jqueryui_forms.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/plugins/ui/ripple.min.js')}}"></script>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Detached sidebar -->
            <div class="sidebar-detached">
                <div class="sidebar sidebar-default sidebar-separate">
                    <div class="sidebar-content">

                        <!-- User details -->
                        <div class="content-group">
                            <div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/{{asset('public/assets/')}}/images/bg.png); background-size: contain;">
                                <div class="content-group-sm">
                                    <h6 class="text-semibold no-margin-bottom">
                                        {{ $tenant->full_name }}
                                    </h6>

                                    <span class="display-block">{{ $tenant->phone_number }}</span>
                                    <span class="display-block">{{ $tenant->email_address }}</span>
                                </div>

                                <a href="#" class="display-inline-block content-group-sm">
                                    <?php $image = $tenant->image; if(!file_exists($image)) { $image = 'public/assets/images/placeholder.jpg' ;}?>
                                    <img src="{{asset($image)}}" class="img-circle img-responsive" alt="{{ $tenant->full_name }}" style="width: 110px; height: 110px;">
                                </a>

                                {{--<ul class="list-inline list-inline-condensed no-margin-bottom">--}}
                                    {{--<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-google-drive"></i></a></li>--}}
                                    {{--<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-twitter"></i></a></li>--}}
                                    {{--<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-github"></i></a></li>--}}
                                {{--</ul>--}}
                            </div>


                        </div>
                        <!-- /user details -->

                    </div>
                </div>
            </div>
            <!-- /detached sidebar -->


            <!-- Detached content -->
            <div class="container-detached">
                <div class="content-detached">
                    <!-- Daily stats -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Basic Information</h6>

                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">

                                <tbody>
                                <tr>
                                    <th style="width:200px;"><p> Full Name :</p></th>
                                    <td><p>{{ $tenant->full_name }}</p> </td>

                                    <th ><p> Id :</p></th>
                                    <td><p>{{ $tenant->id_number }}</p> </td>
                                </tr>
                                <tr>
                                    <th><p>Phone Number :</p></th>
                                    <td><p>{{ $tenant->phone_number }}</p>

                                    </td><th><p>Email Address :</p></th>
                                    <td><p>{{ $tenant->email_address }}</p> </td>
                                </tr>
                                <tr>
                                    <th><p> Plot Name/Number :</p></th>
                                    <td><p>{{ $tenant->plot_name_number }}</p> </td>

                                    <th><p> House Name/Number :</p></th>
                                    <td><p>{{ $tenant->house_name_number }}</p> </td>

                                </tr>
                                <tr>
                                    <th><p> Rome Type:</p></th>
                                    <td><p>{{ $tenant->room_type }}</p> </td>

                                    <th><p> Balance :</p></th>
                                    <td><p>{{ $tenant->balance }}</p> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /daily stats -->
                </div>
            </div>
            <!-- /detached content -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Basic Information</h6>

                </div>

                <div class="table-responsive">
                    <table class="table table-borderless">

                        <tbody>
                        <tr>
                            <th class="col-md-6"><span> Balance:</span></th>
                            <td class="col-md-6"><sapn> ${{ $tenant->balance }}</sapn> </td>

                        </tr>
                        <tr>
                            <th ><sapn> Rent Amount :</sapn></th>
                            <td><span>${{ $tenant->rent_amount }}</span> </td>
                        </tr>

                        <tr>
                            <th><span>Gas Bill:</span></th>
                            <td><span>${{ $tenant->gas_bill }}</span> </td>
                        </tr>
                        <tr>
                            <th><span> Water Bill :</span></th>
                            <td><span>${{ $tenant->water_bill }}</span> </td>
                        </tr>
                        <tr>
                            <th><p> Net Bill :</p></th>
                            <td><p>${{ $tenant->net_bill }}</p> </td>

                        </tr>
                        <tr>
                            <th><span> Other Bill:</span></th>
                            <td><span>${{ $tenant->other_bill }}</span> </td>
                        </tr>
                        <tr>
                            <th><span class="text-bold">Total Amount :</span></th>
                            <td><span class="text-bold">${{ $tenant->total_amount }}</span> </td>
                        </tr>
                        <tr>
                            <th><sapn>Payable Amount:</sapn></th>
                            <td><span>${{ $tenant->payable_amount }}</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Payment History</h5>

                </div>


                <table class="table table-bordered table-hover datatable-highlight">
                    <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Payment Date</th>
                        <th>Payment Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        {{--<th>Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($tenant->paymentHistory as $paymentHistory)
                            <td>{{ $loop->iteration }}</td>
                            <?php
                            $date = new DateTime($paymentHistory->payment_date);
                            $payment_date = date_format($date, 'd F Y');
                            ?>
                            <td>{{ $payment_date }}</td>
                            <td>{{ $paymentHistory->payment_type == 1 ? 'Hand Cash' : 'Card'  }}</td>
                            <td>${{ $paymentHistory->amount }}</td>
                            <td>Paid</td>
                            {{--<td class="text-center">--}}
                                {{--<ul class="icons-list">--}}
                                    {{--<li class="text-teal-600"><a href="#"><i class="icon-file-download2"></i></a></li>--}}
                                {{--</ul>--}}
                            {{--</td>--}}
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
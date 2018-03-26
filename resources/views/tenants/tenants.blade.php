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

    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
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
                        <th rowspan="2" >Name</th>

                        <th colspan="4">Contact Information</th>
                        <th colspan="2">payment Information</th>
                        <th rowspan="2">Action</th>

                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <th>Plot Info</th>
                        <th>House Info</th>
                        <th>Room Type</th>
                        <th>Rent Amount</th>
                        <th>Balance</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tenants as $tenant)
                    <tr>
                        <td>
                            <div class="media-left media-middle">
                                <a href="{{ route('tenants.show', $tenant->id) }}">
                                    <?php $image = $tenant->image; if(!file_exists($image)) { $image = 'public/assets/images/placeholder.jpg' ;}?>
                                    <img src="{{asset($image)}}" class="img-circle img-xs" alt="">
                                </a>
                            </div>
                            <div class="media-left">
                                <div class=""><a href="{{ route('tenants.show', $tenant->id) }}" class="text-default text-semibold">{{ $tenant->full_name }}</a></div>
                                <div class="text-muted text-size-small">
                                    ID:-{{ $tenant->id_number }}
                                </div>
                            </div>
                        </td>
                        <td>{{ $tenant->phone_number }}</td>
                        <td>{{ $tenant->plot_name_number }}</td>
                        <td>{{ $tenant->house_name_number }}</td>
                        <td>{{ $tenant->room_type }}</td>
                        <td>${{ $tenant->rent_amount }}</td>
                        <td>${{ $tenant->balance }}</td>
                        <td class="text-center">
                            <ul  class="icons-list">
                                <li class="text-primary-600"><a href="{{ route('tenants.edit',$tenant->id) }}"><i class="icon-pencil7"></i></a></li>
                                <li class="text-danger-600" id="{{ $tenant->id }}"><a href="#" class="delete-tenant"><i class="icon-trash"></i></a></li>
                                <li class="text-info-600"><a href="{{ route('tenants.show', $tenant->id) }}"><i class="icon-eye"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
99        $(function(){
            // Alert combination
            $('.delete-tenant').on('click', function() {
                var id = $(this).parent('li').attr('id');
                var c_obj = $(this).parents("tr");
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#EF5350",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            alert(id);
                            $.ajax({
                                type:'get',
                                url:'tenants/delete/'+id,
                                dataType:'json',
                                success:function(data){
                                    console.log(data);
                                    swal({
                                        title: "Deleted!",
                                        text: "Tenant Information has been deleted.",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success"
                                    });
                                    c_obj.remove();

                                },error:function(){
                                    swal({
                                        title: "Cancelled",
                                        text: "Delete is Not Completed :(",
                                        confirmButtonColor: "#2196F3",
                                        type: "error"
                                    });
                                }
                            });


                        }
                        else {
                            swal({
                                title: "Cancelled",
                                text: "Your imaginary file is safe :)",
                                confirmButtonColor: "#2196F3",
                                type: "error"
                            });
                        }
                    });
            });
        })

    </script>
@endsection
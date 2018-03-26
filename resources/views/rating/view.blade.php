@extends('layouts.app')

@section('title','View User Rating')

@section('assets')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jquery_ui/widgets.min.js')}}"></script>

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
                    <h5 class="panel-title">User Suggestion And Question Information</h5>

                </div>

                <table class="table table-bordered table-hover datatable-highlight">
                    <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Name</th>
                        <th>Email Or Phone</th>
                        <th>Message</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ratings as $rating)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rating->name }}</td>
                            <td>{{ $rating->email}}</td>

                            <td>{{ $rating->message }}</td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="text-primary-600"><a href="{{ route('rating.show',$rating->id) }}"><i class="icon-pencil7"></i></a></li>
                                    <li class="text-danger-600"><a href="#" class="delete_expense"><i class="icon-trash"></i></a></li>
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
@endsection
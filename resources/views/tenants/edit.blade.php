@extends('layouts.app')

@section('title','Create Tenant')

@section('assets')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jquery_ui/core.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/wizards/form_wizard/form.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/wizards/form_wizard/form_wizard.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/forms/validation/validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/extensions/cookie.js')}}"></script>

    <script type="text/javascript" src="{{asset('public/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/wizard_form.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/pages/wizard_steps.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel ">
                <div class="panel-heading bg-primary-400">
                    <h6 class="panel-title">Create Tenant Form</h6>
                    <div class="heading-elements">

                    </div>
                </div>
                <div class="panel-body">
                    @include('includes.message')
                </div>

                <form class="form-validation"  action="{{ route('tenants.update',$tenant->id) }}" name="edit_tenant_info" method="POST" enctype='multipart/form-data'>
                    {{ csrf_field()}}
                    {{ method_field('PUT')}}
                    <fieldset class="step" id="step1">
                        <h6 class="form-wizard-title text-semibold">
                            <span class="form-wizard-count">1</span>
                            Personal info
                            <small class="display-block">Tell us a bit about yourself</small>
                        </h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="full_name" value="{{ $tenant->full_name }}" class="form-control required" placeholder="John Doe">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ID Number: <span class="text-danger">*</span></label>
                                    <input type="text" name="id_number" value="{{ $tenant->id_number }}" class="form-control required" placeholder="Id Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email address: <span class="text-danger">*</span></label>
                                    <input type="email" name="email_address" value="{{ $tenant->email_address }}" class="form-control required" placeholder="your@email.com">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone #: <span class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" value="{{ $tenant->phone_number }}" class="form-control required" placeholder="+99-99-9999-9999" data-mask="+99-99-9999-9999">
                                </div>
                            </div>
                        </div>

                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block">Image: <span class="text-danger">*</span></label>
                                    <input type="file" name="image" value="{{ old('image') }}" class="file-styled" accept="image/*">
                                    <span class="help-block">Accepted formats: jpg, png. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php $image = $tenant->image; if(!file_exists($image)){ $image = 'public/assets/images/placeholder.jpg' ; }?>
                                    <img src="{{ asset($image) }}" width="200" height="200" alt="image">
                                </div>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset class="step" id="step2">
                        <h6 class="form-wizard-title text-semibold">
                            <span class="form-wizard-count">2</span>
                            Plot/House Information
                        </h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Plot Name/Number: <span class="text-danger">*</span></label>
                                    <input type="text" name="plot_name_number" value="{{ $tenant->plot_name_number }}" placeholder="plot Name/Number" class="form-control required">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>House Name/Number: <span class="text-danger">*</span></label>
                                    <input type="text" name="house_name_number" value="{{ $tenant->house_name_number }}" placeholder="House Name/Number" class="form-control required">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Room Type: <span class="text-danger">*</span></label>
                                    <select name="room_type" data-placeholder="Choose a Room Type..." class="select required">
                                        <option></option>
                                        <option value="Single room">Single room</option>
                                        <option value="Double room">Double room</option>
                                        <option value="One bedroom">One bedroom</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                    </fieldset>

                    <fieldset class="step" id="step3">
                        <h6 class="form-wizard-title text-semibold">
                            <span class="form-wizard-count">3</span>
                            Balance & Rent Information
                            <small class="display-block">Previous work places</small>
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balance: <span class="text-danger">*</span></label>
                                    <input type="number" name="balance" value="{{ $tenant->balance }}" placeholder="Balance Amount" class="form-control required">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rent Amount: <span class="text-danger">*</span></label>
                                    <input type="text" name="rent_amount" value="{{ $tenant->rent_amount }}" placeholder="Rent Amount" class="form-control required">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gas Bill: </label>
                                    <input type="number" name="gas_bill" value="{{ $tenant->gas_bill }}" placeholder="Gas Bill Amount" class="form-control">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Water Bill: </label>
                                    <input type="text" name="water_bill" value="{{ $tenant->water_bill }}" placeholder="water Bill Amount" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Net Bill:</label>
                                    <input type="number" name="net_bill" value="{{ $tenant->net_bill }}" placeholder="Net Bill Amount" class="form-control">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Other Bill: </label>
                                    <input type="text" name="other_bill" value="{{ $tenant->other_bill }}" placeholder="other Bill Amount" class="form-control">
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <div class="form-wizard-actions">
                        <button class="btn btn-default" id="basic-back" type="reset">Back</button>
                        <button class="btn btn-info" id="basic-next"   type="submit">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var a = 1;
        $('#basic-next').click(function(){
            if(a == 2){
                $(this).attr('type', 'submit');
            }else{
                $(this).attr('type','button');
                a += 1;
            }
        });

        document.forms['edit_tenant_info'].elements['room_type'].value={{ $tenant->room_type }}
    </script>

@endsection

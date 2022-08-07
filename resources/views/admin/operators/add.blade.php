@extends('admin.layouts.master')
@section("title") Add Operator | {{ env('APP_NAME') }} @endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Add Operator</span>
                <span class="badge badge-primary badge-pill animated flipInX"></span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" class="jquery-validation-form custom-form" action="{{ route('operator.store') }}" id="create_customer" method="POST">
                <div class="row">
                    <div class=col-md-6>
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="company_name"><span class="text-danger">*</span>Company Name:</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ old('company_name') }}" type="text" class="form-control" name="company_name"
                                placeholder="Company name" />
                                @error('company_name')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Operator Name</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ old('operator_name') }}" type="text" class="form-control" name="operator_name"
                                placeholder="Operator name" >
                                @error('operator_name')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Contact Number</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ old('contact_number') }}" type="text" class="form-control" name="contact_number"
                                       placeholder="Contact number" />
                                @error('contact_number')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Aadhaar Card Number</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ old('aadhaar_number') }}" type="text" class="form-control" name="aadhaar_number" placeholder="Aadhaar card Number" >
                                @error('aadhaar_number')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">GSTIN Number</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ old('gstin_number') }}" type="text" class="form-control" name="gstin_number" placeholder="GSTIN number" >
                                @error('gstin_number')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Date of birth</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ old('dob') }}" type="text" class="form-control date-picker" name="dob" placeholder="DOB" />
                                @error('dob')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                    </div>
                    <div class ="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label "><span class="text-danger">*</span>Address</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ old('address') }}" type="text" class="form-control" name="address"
                                placeholder="Operator address" />
                                @error('address')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Whatsapp Number</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ old('secondary_number') }}" type="text" class="form-control" name="secondary_number" placeholder="Secondary number" >
                                @error('secondary_number')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Licence</label>
                            <div class="col-lg-8">
                                <input type="file" name="licence" />
                                @error('licence')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Agreement</label>
                            <div class="col-lg-8">
                                <input type="file" name="agreement" />
                                @error('agreement')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-primary">Create New Operator<i class="icon-database-insert ml-1"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.date-picker').datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            yearRange: "1950:c"
        });
        $('#create_customer').validate({
            rules: {
                customer_contact_number: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                customer_email_address: {
                    email: true
                },
                aadhar_no: {
                    minlength: 12,
                    maxlength: 12,
                    digits: true
                },
                connection_date: "required",
                customer_name: "required",
                customer_address: "required",
                customer_email: "required",
                contact_number_two: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                }
            },
            messages: {
                customer_contact_number: {
                    required: "Please enter mobile number",
                    minlength: "Please enter 10 digits",
                    maxlength: "Please enter 10 digits",
                    digits: "Only numbers are allowed"
                },
                aadhar_no: {
                    minlength: "Please enter 12 digits",
                    maxlength: "Please enter 12 digits",
                    digits: "Only numbers are allowed"
                },
                customer_email_address: {
                    email: "Please enter valid email id"
                },
                customer_address: "Please enter address",
                anniversary_date: "Please enter anniverseryDate",
                customer_email: "Please enter Client Id",
                customer_name: "Please enter Client Name",
                contact_number_two: "Please enter whatsapp number",
                connection_date: "Please enter Date of Connection"
            }
        });
    });
</script>
@endsection
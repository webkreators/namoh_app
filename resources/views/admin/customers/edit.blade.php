@extends('admin.layouts.master')
@section("title") Edit Customer | {{ env('APP_NAME') }} @endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Editing - <span class="badge badge-primary badge-pill animated flipInX">{{ $customer->customer_name }}</span></span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <form class="jquery-validation-form custom-form" action="{{ route('customers.update', $customer->client_id) }}" id="create_customer" method="POST">
                <div class="row">
                    <div class=col-md-6>
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Title:</label>
                            <div class="col-lg-8">
                                <select class="form-control select-search error" name="name_title" id="type" value="{{ old('name_title') }}">
                                    <option value="">Select title</option>
                                    <option value="Mr" {{ $customer->name_title == 'Mr' ? 'selected' : '' }} class="text-capitalize">Mr</option>
                                    <option value="Ms" {{ $customer->name_title == 'Ms' ? 'selected' : '' }} class="text-capitalize">Ms</option>
                                    <option value="Mrs" {{ $customer->name_title == 'Mrs' ? 'selected' : '' }} class="text-capitalize">Mrs</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Email:</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->customer_email_address }}" type="email" class="form-control" name="customer_email_address" placeholder="Customer email" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Contact Number one</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->customer_contact_number }}" type="text" class="form-control" name="customer_contact_number" placeholder="Contact Number one" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Aadhar Card Number</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->aadhar_no }}" type="text" class="form-control" name="aadhar_no" placeholder="Aadhar card Number" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">GSTIN Number</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->gstin_no }}" type="text" class="form-control" name="gstin_no" placeholder="GSTIN number" >
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Anniversery Date</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->anniversary_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $customer->anniversary_date)->format('d/m/Y') : '' }}" type="text" class="form-control date-picker" name="anniversary_date" placeholder="Select anniversery date" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Client Id</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->customer_email }}" type="text" class="form-control" name="customer_email" placeholder="Client id" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Remarks</label>
                            <div class="col-lg-8">
                                <textarea class="form-control form-control" placeholder="Enter Remarks" id="floatingTextarea" name="remarks">{{ $customer->remarks }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class ="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Client/Firm Name</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->customer_name }}" type="text" class="form-control" name="customer_name" placeholder="Client/Firm Name" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label "><span class="text-danger">*</span>Address</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->customer_address }}" type="text" class="form-control" name="customer_address" placeholder="Customer address" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Whatsapp Number</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->contact_number_two }}" type="text" class="form-control" name="contact_number_two" placeholder="Alternate number" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Pan Card Number</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->pan_no }}" type="text" class="form-control" name="pan_no" placeholder="pan card number" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Birth Date</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->dob != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $customer->dob)->format('d/m/Y') : '' }}" type="text" class="form-control date-picker" name="dob" placeholder="Select date of birth" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Connection Date</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $customer->connection_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $customer->connection_date)->format('d/m/Y') : '' }}" type="text" class="form-control date-picker" name="connection_date" placeholder="Select connection date" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Static IP</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' type="text" value="{{ $customer->static_ip }}" class="form-control" name="static_ip" placeholder="Static IP" />
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update Customer<i class="icon-database-insert ml-1"></i></button>
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
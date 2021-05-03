@extends('admin.layouts.master')
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Add New User</span>
                <span class="badge badge-primary badge-pill animated flipInX"></span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <form class="jquery-validation-form custom-form" action="{{ route('user.post') }}" id="create_user" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Name:</label>
                            <div class="col-lg-9">
                                <input autocomplete='off' type="text" class="form-control form-control-lg" name="company_name" placeholder="Name">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Mobile No:</label>
                            <div class="col-lg-9">
                                <input autocomplete='off' type="text" class="form-control form-control-lg" name="company_mobile" placeholder="Enter user contact no">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Role:</label>
                            <div class="col-lg-9">
                                <select class="form-control select-search error" name="user_type" id="user_type">
                                    <option value="">Select user type</option>
                                    <option value="1" class="text-capitalize">Admin</option>
                                    <option value="2" class="text-capitalize">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Aadhar Card No:</label>
                            <div class="col-lg-9">
                                <input autocomplete='off' type="text" class="form-control form-control-lg" name="aadhar_card_no" placeholder="Enter user aadhar No">
                                @error('aadhar')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Designation:</label>
                            <div class="col-lg-9">
                                <input autocomplete='off' type="text" class="form-control form-control-lg" name="designation" placeholder="Enter Designation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>User Login:</label>
                            <div class="col-lg-9">
                                <input autocomplete='off' type="text" class="form-control form-control-lg" name="user_name" placeholder="Enter User Login id">
                            </div>
                        </div>
                        <div class="form-group row form-group-feedback form-group-feedback-right">
                            <label class="col-lg-3 col-form-label">Password:</label>
                            <div class="col-lg-9">
                                <input autocomplete='off' id="passwordInput" type="password" class="form-control form-control-lg" name="password"
                                    placeholder="Enter Password" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Add User</button>
                            <button type="button" class="btn btn-primary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#create_user').validate({
            rules: {
                company_name: "required",
                company_mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                user_type: "required",
                aadhar_card_no: {
                    required: true,
                    minlength: 12,
                    maxlength: 12,
                    digits: true
                },
                designation: "required",
                user_name: "required",
                password: "required",
            },
            messages: {
                company_name: "Please enter User name",
                company_mobile: {
                    required: "Please enter mobile number",
                    minlength: "Please enter 10 digits",
                    maxlength: "Please enter 10 digits",
                    digits: "Only numbers are allowed"
                },
                user_type: "Please select User type",
                aadhar_card_no: {
                    required: "Please enter aadhar number",
                    minlength: "Please enter 12 digits",
                    maxlength: "Please enter 12 digits",
                    digits: "Only numbers are allowed"
                },
                designation: "Please enter designation",
                user_name: "please enter userlogin",
                password: "Please enter password",
            }
        });
        $('.select2').select2();
    });
</script>
@endsection
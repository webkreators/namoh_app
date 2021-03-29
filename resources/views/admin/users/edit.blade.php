@extends('admin.layouts.master')
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Editing - {{ $user->company_name }}</span>
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
                    <form class="jquery-validation-form" action="{{ route('user.update', $user->login_id) }}" id="create_user" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Name:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" value="{{ $user->company_name }}" name="company_name" placeholder="Name">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Mobile No:</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control-lg" value="{{ $user->company_mobile }}" name="company_mobile" placeholder="Enter user contact no">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Role:</label>
                            <div class="col-lg-9">
                                <select class="form-control select-search error" name="user_type" id="user_type">
                                    <option value="">Select user type</option>
                                    <option value="1" class="text-capitalize" {{ $user->user_type == '1' ? 'selected' : '' }}>Admin</option>
                                    <option value="2" class="text-capitalize" {{ $user->user_type == '2' ? 'selected' : '' }}>Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Aadhar Card No:</label>
                            <div class="col-lg-9">
                                <input value="{{ $user->aadhar_card_no }}" type="text" class="form-control form-control-lg" name="aadhar_card_no" placeholder="Enter user aadhar No">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Designation:</label>
                            <div class="col-lg-9">
                                <input value="{{ $user->designation }}"  type="text" class="form-control form-control-lg" name="designation" placeholder="Enter Designation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>User Login:</label>
                            <div class="col-lg-9">
                                <input value="{{ $user->user_name }}" type="text" class="form-control form-control-lg" name="user_name" placeholder="Enter User Login id">
                            </div>
                        </div>
                        <div class="form-group row form-group-feedback form-group-feedback-right">
                            <label class="col-lg-3 col-form-label">Password:</label>
                            <div class="col-lg-9">
                                <input id="passwordInput" type="password" class="form-control form-control-lg" name="password" placeholder="Keep it blank if you don't want to change password" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Status:</label>
                            <div class="col-lg-9">
                                <select class="form-control select-search error" name="status" id="status">
                                    <option value="">Select user status</option>
                                    <option value="0" class="text-capitalize" {{ $user->status == 0 ? 'selected' : '' }}>Active</option>
                                    <option value="1" class="text-capitalize" {{ $user->status == 1 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update User</button>
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
                status: 'required'
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
                status: 'Please select one status'
            }
        });
        $('.select2').select2();
    });
</script>
@endsection
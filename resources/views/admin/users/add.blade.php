@extends('admin.layouts.master')
@section('content')
<div class="page-header">
<div class="page-header-content header-elements-md-inline">
<div class="page-title d-flex">
<h4><i class="icon-circle-right2 mr-2"></i>
<span class="font-weight-bold mr-2">Add User</span>
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
<form class="jquery-validation-form" action="{{ route('user.add') }}" id="create_user" method="POST">
@csrf
<div class="form-group row">
<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Name:</label>
<div class="col-lg-9">
<input value="{{ old('name') }}" type="text" class="form-control form-control-lg" name="name"
placeholder="Name" >
</div>
</div>

<div class="form-group row">
<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Mobile No:</label>
<div class="col-lg-9">
<input value="{{ old('mobile') }}" type="text" class="form-control form-control-lg" name="mobile"
placeholder="Enter user contact no" >
@error('mobile')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
</div>
</div>
<div class="form-group row">
<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Role:</label>
<div class="col-lg-9">
<select class="form-control select-search error" name="type" id="type" value="{{ old('type') }}">
<option value="">Select user type</option>
<option value="admin" {{ old('type') == 'admin' ? 'selected' : ''}} class="text-capitalize">Admin</option>
<option value="manager" {{ old('type') == 'manager' ? 'selected' : ''}} class="text-capitalize">Manager</option>
</select>
@error('role')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
</div>
</div>
<div class="form-group row">
<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Aadhar Card No:</label>
<div class="col-lg-9">
<input value="{{ old('aadhar') }}" type="text" class="form-control form-control-lg" name="aadhar"
placeholder="Enter user aadhar No" >
@error('aadhar')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
</div>
</div>

<div class="form-group row">
<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Designation:</label>
<div class="col-lg-9">
<input value="{{ old('designation') }}" type="text" class="form-control form-control-lg" name="designation"
placeholder="Enter Designation" >
@error('designation')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
</div>
</div>
<div class="form-group row">
<label class="col-lg-3 col-form-label"><span class="text-danger">*</span>User Login:</label>
<div class="col-lg-9">
<input value="{{ old('userlogin') }}" type="text" class="form-control form-control-lg" name="userlogin"
placeholder="Enter User Login id" >
@error('userlogin')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
</div>
</div>
<div class="form-group row form-group-feedback form-group-feedback-right">
<label class="col-lg-3 col-form-label">Password:</label>
<div class="col-lg-9">
<input id="passwordInput" type="password" class="form-control form-control-lg" name="password" placeholder="Enter Password" autocomplete="new-password">
@error('password')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror

</div>
</div>
<div class="text-left">
<button type="submit" class="btn btn-primary">
submit

</button>
<button type="submit" class="btn btn-primary">
cancel

</button>
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
      name: "required",
      mobile: "required",
      type: "required",
      aadhar: "required",
      designation: "required",
      userlogin: "required",
      password: "required",
    }
    ,
    messages: {
      name: "Please enter User name",
      
      mobile: "Please enter mobile no.",
      type: "enter  user type",
      
      aadhar: "Please enter aadhar",
      designation: "Please enter designation",
      userlogin: "please enter userlogin",
      password: "Please enter password",
    }
  });
  
  $('.select2').select2();
  $("#type").change(function() {
    var type = $(this).val();
    if (type == "manager") {
      $("#permissions").removeClass('hidden');
      $('.select2').select2('reload');
    } else {
      $("#permissions").addClass('hidden');
    }
  });
  
});
</script>
@endsection
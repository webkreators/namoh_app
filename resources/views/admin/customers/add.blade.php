@extends('admin.layouts.master')
@section('content')
<div class="page-header">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><i class="icon-circle-right2 mr-2"></i>
        <span class="font-weight-bold mr-2">Add Customer</span>
        <span class="badge badge-primary badge-pill animated flipInX"></span>
      </h4>
      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
  </div>
</div>
<div class="content">
    <div class="card">
      <div class="card-body">
      <form class="jquery-validation-form" action="{{ route('customer.post') }}" id="create_customer" method="POST">
      <div class="row">
      <div class=col-md-6>
          @csrf
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Title:</label>
            <div class="col-lg-9">
            <select class="form-control select-search error" name="name_title" id="type" value="{{ old('name_title') }}">
                <option value="">Select title</option>
                <option value="Mr"  class="text-capitalize">Mr</option>
                <option value="Ms"  class="text-capitalize">Ms</option>
                <option value="Mrs"  class="text-capitalize">Mrs</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Email:</label>
            <div class="col-lg-9">
              <input value="{{ old('customer_email_address') }}" type="email" class="form-control form-control-lg" name="customer_email_address"
              placeholder="Customer email" >
              @error('customer_email_address')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Contact Number one</label>
            <div class="col-lg-9">
              <input value="{{ old('customer_contact_number') }}" type="text" class="form-control form-control-lg" name="customer_contact_number"
              placeholder="Contact Number one" >
              @error('customer_contact_number')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Aadhar Card Number</label>
            <div class="col-lg-9">
              <input value="{{ old('aadhar_no') }}" type="text" class="form-control form-control-lg" name="aadhar_no"
              placeholder="Aadhar card Number" >
              @error('aadhar_no')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>GSTIN Number</label>
            <div class="col-lg-9">
              <input value="{{ old('gstin_no') }}" type="text" class="form-control form-control-lg" name="gstin_no"
              placeholder="GSTIN number" >
              @error('gstin_no')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>    
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Anniversery Date</label>
            <div class="col-lg-9">
              <input value="{{ old('anniversary_date') }}" type="date" class="form-control form-control-lg" name="anniversary_date"
              placeholder="Select anniversery-date" >
              @error('anniversary_date')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Client Id</label>
            <div class="col-lg-9">
              <input value="{{ old('customer_email') }}" type="text" class="form-control form-control-lg" name="customer_email"
              placeholder="Client id" >
              @error('customer_email')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Remarks</label>
            <div class="col-lg-9">
            <textarea class="form-control form-control form-control-lg" placeholder="Enter Remarks" id="floatingTextarea" name="remarks"></textarea>
              @error('remarks')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          </div>
          
          <div class ="col-md-6">
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Client/Firm Name</label>
            <div class="col-lg-9">
              <input value="{{ old('customer_name') }}" type="text" class="form-control form-control-lg" name="customer_name"
              placeholder="Client/Firm Name" >
              @error('customer_name')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label "><span class="text-danger">*</span>Address</label>
            <div class="col-lg-9">
              <input value="{{ old('customer_address') }}" type="text" class="form-control form-control-lg" name="customer_address"
              placeholder="Customer address" >
              @error('customer_address')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Contact Number-2</label>
            <div class="col-lg-9">
              <input value="{{ old('contact_number_two') }}" type="number" class="form-control form-control-lg" name="contact_number_two"
              placeholder="Alternate number" >
              @error('contact_number_two')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Pan Card Number</label>
            <div class="col-lg-9">
              <input value="{{ old('pan_no') }}" type="text" class="form-control form-control-lg" name="pan_no"
              placeholder="pan card number" >
              @error('pan_no')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Date of Birth</label>
            <div class="col-lg-9">
              <input value="{{ old('DOB') }}" type="date" class="form-control form-control-lg" name="dob"
              placeholder="Enter date of birth" >
              @error('dob')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Date Of Connection</label>
            <div class="col-lg-9">
              <input value="{{ old('date-of-connection') }}" type="date" class="form-control form-control-lg" name="connection_date"
              placeholder="Enter Static ip" >
              @error('connection_date')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          </div>
        
          <div class="text-left">
            <button type="submit" class="btn btn-primary">
              submit
              
            </button>
            <button type="cancel" class="btn btn-primary">
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
      $('#create_customer').validate({
          rules: {
            name_title: "required",
            customer_contact_number: {
                  required: true,
                  minlength: 10,
                  maxlength: 10,
                  digits: true
              },
              customer_email_address: "required",
              aadhar_no: {
                  required: true,
                  minlength: 12,
                  maxlength: 12,
                  digits: true
              },
              remarks: "required",
              dob: "required",
              connection_date: "required",
              anniversary_date: "required",
              customer_name: "required",
              gstin_no: "required",
              pan_no: "required",
              customer_address: "required",
              customer_email: "required",
              contact_number_two: "required",
          },

          messages: {
            name_title: "Please enter title",
            customer_contact_number: {
              required: "Please enter mobile number",
              minlength: "Please enter 10 digits",
              maxlength: "Please enter 10 digits",
              digits: "Only numbers are allowed"
            },
            aadhar_no: {
                required: "Please enter aadhar number",
                minlength: "Please enter 12 digits",
                maxlength: "Please enter 12 digits",
                digits: "Only numbers are allowed"
            },
            gstin_no: "Please enter GSTIN number",
            customer_email_address:"Please enter Client email Id",
            dob:"Please enter DOB",
            pan_no:"please enter Pan Card Number",
            customer_address:"Please enter address",
            anniversary_date:"Please enter anniverseryDate",
            customer_email:"Please enter Client Id",
            remarks:"Please enter remarks",
            customer_name:"Please enter Client Name",
            contact_number_two:"Please enter alternate contact number",
            pan_no:"please enter Pan Card Number",
            connection_date:"Please enter Date of Connection"
          }
      });
  $('.select2').select2();
  });
</script>
@endsection
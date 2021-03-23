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
        <div class="row">
        <div class=col-md-6>
        <form class="jquery-validation-form" action="{{ route('customer.add') }}" id="create_client" method="POST">
            @csrf
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Title:</label>
              <div class="col-lg-9">
              <select class="form-control select-search error" name="title" id="type" value="{{ old('title') }}">
                  <option value="">Select user type</option>
                  <option value="admin"  class="text-capitalize">Admin</option>
                  <option value="manager"  class="text-capitalize">Manager</option>
                </select>
              </div>
            </div>
           <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Email:</label>
              <div class="col-lg-9">
                <input value="{{ old('email') }}" type="text" class="form-control form-control-lg" name="email"
                placeholder="Client email" >
                @error('email')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Contact No-1</label>
              <div class="col-lg-9">
                <input value="{{ old('contact1') }}" type="text" class="form-control form-control-lg" name="contact1"
                placeholder="Contact Number" >
                @error('contact1')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Aadhar Card Number</label>
              <div class="col-lg-9">
                <input value="{{ old('aadhar') }}" type="text" class="form-control form-control-lg" name="aadhar"
                placeholder="Aadhar card Number" >
                @error('aadhar')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>GSTIN Number</label>
              <div class="col-lg-9">
                <input value="{{ old('gstNo') }}" type="text" class="form-control form-control-lg" name="gstNo"
                placeholder="GSTIN number" >
                @error('gstNo')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
         
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Anniversery Date</label>
              <div class="col-lg-9">
                <input value="{{ old('anniverseryDate') }}" type="text" class="form-control form-control-lg" name="anniverseryDate"
                placeholder="Select anniversery-date" >
                @error('anniverseryDate')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Client Id</label>
              <div class="col-lg-9">
                <input value="{{ old('clientId') }}" type="text" class="form-control form-control-lg" name="clientId"
                placeholder="Client id" >
                @error('clientId')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
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
                <input value="{{ old('clientName') }}" type="text" class="form-control form-control-lg" name="clientName"
                placeholder="Client/Firm Name" >
                @error('clientName')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label "><span class="text-danger">*</span>Address</label>
              <div class="col-lg-9">
                <input value="{{ old('address') }}" type="text" class="form-control form-control-lg" name="address"
                placeholder="Client address" >
                @error('address')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Contact Number-2</label>
              <div class="col-lg-9">
                <input value="{{ old('contact-no-2') }}" type="text" class="form-control form-control-lg" name="contact-no-2"
                placeholder="Alternate number" >
                @error('contact2')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Pan Card Number</label>
              <div class="col-lg-9">
                <input value="{{ old('panNumber') }}" type="text" class="form-control form-control-lg" name="panNumber"
                placeholder="pan card number" >
                @error('panNumber')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>DOB</label>
              <div class="col-lg-9">
                <input value="{{ old('DOB') }}" type="text" class="form-control form-control-lg" name="panNumber"
                placeholder="DOB" >
                @error('DOB')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Date Of Connection</label>
              <div class="col-lg-9">
                <input value="{{ old('date-of-connection') }}" type="text" class="form-control form-control-lg" name="DateOfConnection"
                placeholder="Enter Static ip" >
                @error('DateOfConnection')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
              </div>
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
    $('#create_client').validate({
      rules: {
        title: "required",
         email: "required",
         contact1: "required",
         aadhar:"required",
         gstNo:"required",
         anniverseryDate:"required",
         clientId:"required",
         remarks:"required",
         clientName:"required",
         address:"required",
         contact2:"required",
         panNumber:"required",
         DOB:"required",
         DateOfConnection:"required",

        ,
        }
      ,
      messages: {
        title: "Please enter title",
         email: "Please enter email",
         contact1: "please enter contact",
         aadhar:"Please enter aadhar",
         gstNo:"Please enter GSTIn Number",
         anniverseryDate:"Please enter anniverseryDate",
         clientId:"Please enter Client Id",
         remarks:"Please enter remarks",
         clientName:"Please enter Client Name",
         address:"Please enter address",
         contact2:"Please enter contact",
         panNumber:"please enter Pan Card Number",
         DOB:"Please enter DOB",
         DateOfConnection:"Please enter Date of Connection",
    
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
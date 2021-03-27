@extends('admin.layouts.master')
@section("title") Update Customer - Dashboard
@endsection
@section('content')
<div class="page-header">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><i class="icon-circle-right2 mr-2"></i>
        <span class="font-weight-bold mr-2">Editing</span>
        <span class="badge badge-primary badge-pill animated flipInX">"{{ $customer->customer_name }}"</span>
      </h4>
      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
  </div>
</div>
<div class="content">
  <div class="card">
    <div class="card-body">
      <legend class="font-weight-semibold text-uppercase font-size-sm">
        <i class="icon-address-book mr-2"></i> Customer Details
      </legend>
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
          <input name="_method" type="hidden" value="PUT">
          @csrf
            <input type="hidden" name="id" value="">
            <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Title:</label>
            <div class="col-lg-9">
            <select class="form-control select-search error" name="name_title" id="type" value="{{ $customer->name_title }}">
              <option value="">Select title</option>
              <option value="Mr"  class="text-capitalize" {{ $customer->name_title == 'Mr' ? 'selected' : '' }}>Mr</option>
              <option value="Ms"  class="text-capitalize" {{ $customer->name_title == 'Ms' ? 'selected' : '' }}>Ms</option>
              <option value="Mrs"  class="text-capitalize" {{ $customer->name_title == 'Mrs' ? 'selected' : '' }}>Mrs</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Email:</label>
            <div class="col-lg-9">
              <input value="{{ $customer->customer_email_address }}" type="email" class="form-control form-control-lg" name="customer_email_address"
              placeholder="Customer email" >
              @error('customer_email_address')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Contact Number one</label>
            <div class="col-lg-9">
              <input value="{{ $customer->customer_contact_number }}" type="text" class="form-control form-control-lg" name="customer_contact_number"
              placeholder="Contact Number one" >
              @error('customer_contact_number')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Aadhar Card Number</label>
            <div class="col-lg-9">
              <input value="{{ $customer->aadhar_no }}" type="text" class="form-control form-control-lg" name="aadhar_no"
              placeholder="Aadhar card Number" >
              @error('aadhar_no')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>GSTIN Number</label>
            <div class="col-lg-9">
              <input value="{{ $customer->gstin_no }}" type="text" class="form-control form-control-lg" name="gstin_no"
              placeholder="GSTIN number" >
              @error('gstin_no')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>    
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Anniversery Date</label>
            <div class="col-lg-9">
              <input value="{{ $customer->anniversary_date }}" type="date" class="form-control form-control-lg" name="anniversary_date"
              placeholder="Select anniversery-date" >
              @error('anniversary_date')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Client Id</label>
            <div class="col-lg-9">
              <input value="{{ $customer->customer_email }}" type="text" class="form-control form-control-lg" name="customer_email"
              placeholder="Client id" >
              @error('customer_email')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Remarks</label>
            <div class="col-lg-9">
            <textarea class="form-control form-control form-control-lg" placeholder="Enter Remarks" id="floatingTextarea" name="remarks">{{ $customer->remarks }}</textarea>
              @error('remarks')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
        </div>
        <div class ="col-md-6">
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Client/Firm Name</label>
            <div class="col-lg-9">
              <input value="{{ $customer->customer_name }}" type="text" class="form-control form-control-lg" name="customer_name"
              placeholder="Client/Firm Name" >
              @error('customer_name')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label "><span class="text-danger">*</span>Address</label>
            <div class="col-lg-9">
              <input value="{{ $customer->customer_address }}" type="text" class="form-control form-control-lg" name="customer_address"
              placeholder="Customer address" >
              @error('customer_address')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Contact Number-2</label>
            <div class="col-lg-9">
              <input value="{{ $customer->contact_number_two }}" type="number" class="form-control form-control-lg" name="contact_number_two"
              placeholder="Alternate number" >
              @error('contact_number_two')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Pan Card Number</label>
            <div class="col-lg-9">
              <input value="{{ $customer->pan_no }}" type="text" class="form-control form-control-lg" name="pan_no"
              placeholder="pan card number" >
              @error('pan_no')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Date of Birth</label>
            <div class="col-lg-9">
              <input value="{{ $customer->dob }}" type="date" class="form-control form-control-lg" name="dob"
              placeholder="Enter date of birth" >
              @error('dob')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label"><span class="text-danger">*</span>Date Of Connection</label>
            <div class="col-lg-9">
              <input value="{{ $customer->connection_date }}" type="date" class="form-control form-control-lg" name="connection_date"
              placeholder="Enter Static ip" >
              @error('connection_date')<label id="type-error" class="error" for="type">{{ $message }}</label>@enderror
            </div>
          </div>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-primary">
            UPDATE
            <i class="icon-database-insert ml-1"></i>
          </button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
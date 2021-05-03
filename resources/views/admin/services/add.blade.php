@extends('admin.layouts.master')
@section("title") Add Service - Dashboard @endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Add New Service</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="jquery-validation-form custom-form" action="{{ route('services.store') }}" id="service_form" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Product service Name:</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' type="text" class="form-control" name="product_name" placeholder="Enter product/service name" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Product /Service Plan</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="product_plan">
                                    <option value="">Select Plan</option>
                                    <option value="1">Monthly</option>
                                    <option value="3">Quarterly</option> 
                                    <option value="4">Half Yearly</option> 
                                    <option value="2">Yearly</option>
                                    <option value="5">2 Years</option>  
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Product /Service Charge</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' type="text" class="form-control" name="product_charge" placeholder="Enter product/service charge" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Description:</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Add Service</button>
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
        $('#service_form').validate({
            rules: {
                product_name: "required",
                product_charge: "required",
                product_plan: "required",
                description: 'required'
            },
            messages: {
                product_name: "Please enter service name",
                description: "Please enter description",
                product_plan: "Please select plan",
                product_charge: "Please enter service charge"
            }
        });
    });
</script>
@endsection
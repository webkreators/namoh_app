@extends('admin.layouts.master')
@section("title") Add Service - Dashboard @endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Editing - <span class="badge badge-primary badge-pill animated flipInX">{{ $service->product_name }}</span></span>
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
                    <form class="jquery-validation-form" action="{{ route('services.update', $service->product_id) }}" id="service_form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Product service Name:</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $service->product_name }}" type="text" class="form-control" name="product_name" placeholder="Enter product/service name" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Product /Service Plan</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="product_plan">
                                    <option value="">Select Plan</option>
                                    @foreach (\App\Models\Service::$plans as $key => $value)
                                    <option {{ $key == $service->product_plan ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Product /Service Charge</label>
                            <div class="col-lg-8">
                                <input autocomplete='off' value="{{ $service->product_charge }}" type="text" class="form-control" name="product_charge" placeholder="Enter product/service charge" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Description:</label>
                            <div class="col-lg-8">
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description">{{ $service->description }}</textarea>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update Service</button>
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
@extends('admin.layouts.master')
@section("title") Add Customer | {{ env('APP_NAME') }} @endsection
@section('content')
<div class="page-header">
    @if (Session::get('alert'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Import Customers</span>
                <span class="badge badge-primary badge-pill animated flipInX"></span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <form class="jquery-validation-form custom-form" enctype="multipart/form-data" action="{{ route('customer.process.import') }}" id="create_customer" method="POST">
                <div class="row">
                    <div class=col-md-6>
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Choose File:</label>
                            <div class="col-lg-9">
                                <input type="file" name="customers" />
                                <div class="text-left mt-4">
                                    <button type="submit" class="btn btn-primary">Import Customers<i class="icon-database-insert ml-1"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
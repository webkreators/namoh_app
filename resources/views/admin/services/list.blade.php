@extends('admin.layouts.master')
@section("title") Services | {{ env('APP_NAME') }} @endsection
@section('content')
<br>
<div class="page-header">
    @if (Session::get('state'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('state') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Total Services</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ $services_count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a href="{{ route('services.create') }}">
                    <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2">
                        <b><i class="icon-plus2"></i></b>
                        Add Services
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form id='user_filters' action="{{ route('services') }}" autocomplete="off" method="GET">
        <div class="form-group row template mt-2">
            <div class="col-lg-4">
                <div class="form-group form-group-feedback form-group-feedback-right search-box">
                    <input type="text" class="form-control" placeholder="Search with service/product name" name="squery" value="{{ request('squery') }}">
                    <div class="form-control-feedback form-control-feedback-lg mt-0">
                        <i class="icon-search4"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <button type="submit" class="btn btn-primary btn-icon" style="margin-left:0;"><i class="icon-search4"></i></button>
                <button type="button" id="clear_form" class="btn alpha-pink text-pink-800 btn-icon ml-2"><i class="icon-cross3"></i></button>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Product Name</th>
                            <th>Product Plan</th>
                            <th>Product Charge</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $key => $service)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ route('services.edit', $service->product_id) }}">{{ $service->product_name }}</a>
                            </td>
                            <td>{{ App\Models\Service::$plans[$service->product_plan] }}</td>
                            <td>{{ $service->product_charge }}</td>
                            <td>{{ $service->description }}</td>
                            <td><a href="{{ route('services.destroy', $service->product_id) }}" class="delete-resource"><i class="icon-trash"></i></a></td>
                        </tr>
                        @endforeach
                        @if (count($services) == 0)
                        <tr>
                            <td colspan="6" class="text-center">No results found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $services->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        var form = $('#user_filters');
        $('#clear_form').click(function () {
            form.find('input').val('');
            form.find('select').val('');
            form.submit();
        });
        $('.delete-resource').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "You are about to delete a service",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    location.href = link;
                }
            });
        });
    });
</script>
@endsection
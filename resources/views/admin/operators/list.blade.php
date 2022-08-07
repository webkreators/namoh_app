@extends('admin.layouts.master')
@section("title") Operators | {{ env('APP_NAME') }} @endsection
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
                <span class="font-weight-bold mr-2">Total Operators</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ $count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none dropdown-toggle dropdownMenuButton-1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-more"></i></a>
            <div class="dropdown-menu custom-menu-drop" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item p-0" href="{{ route('customer.add') }}">
                <button type="button" class="btn bianca-200  btn-labeled add-invoice" style="width: 100%;">
                    <i class="icon-plus2 mr-2"></i>Add Customer
                </button>
            </a>
            </div>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a href="{{ route('operator.add') }}">
                    <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2">
                        <b><i class="icon-plus2"></i></b>
                        Add Operator
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form id='customer_filters' action="{{ route('customers') }}" autocomplete="off" method="GET">
        <div class="form-group row template mt-2">
            <div class="col-lg-5">
                <div class="form-group form-group-feedback form-group-feedback-right search-box">
                    <input type="text" class="form-control form-control-lg " placeholder="Search with customer name/mobile/id" name="squery" value="{{ request('squery') }}">
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
                            <th>Company Name</th>
                            <th>Operator Name</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Whatsapp Number</th>
                            <th>Aadhaar</th>
                            <th>GST</th>
                            <th>DOB</th>
                            <th>Licence</th>
                            <th>Agreement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($operators as $operator)
                        <tr>
                            <td>
                                <a href="{{ route('operator.edit', $operator->id) }}">{{ $operator->company_name }}</a>
                            </td>
                            <td>{{ $operator->operator_name }}</td>
                            <td>{{ $operator->contact_number }}</td>
                            <td>{{ $operator->address }}</td>
                            <td>{{ $operator->secondary_number }}</td>
                            <td>{{ $operator->aadhaar_number }}</td>
                            <td>{{ $operator->gstin_number }}</td>
                            <td>{{ $operator->dob != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $operator->dob)->format('d/m/Y') : '-' }}</td>
                            <td><a href="{{ route('download-file') }}?path={{ $operator->licence }}"><i class="icon-download"></i></a></td>
                            <td><a href="{{ route('download-file') }}?path={{ $operator->agreement }}"><i class="icon-download"></i></a></td>
                            <td><a href="{{ route('invoices') }}?operator_id={{ $operator->id }}"><i class="icon-list3"></i></a></td>
                        </tr>
                        @endforeach
                        @if (count($operators) == 0)
                        <tr>
                            <td colspan="8" class="text-center">No results found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-3">
                  {{ $operators->appends(request()->except('page'))->links() }}
              </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        var form = $('#customer_filters');
        $('#clear_form').click(function () {
            form.find('input').val('');
            form.find('select').val('');
            form.submit();
        });
        $('#excel_export').click(function () {
            form.find("input[name='excel_export']").val(1);
            form.attr('target', '_blank').submit();
            form.removeAttr('target');
            form.find("input[name='excel_export']").val(0);
        });
        $('.delete-resource').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "You are about to delete a customer",
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
@extends('admin.layouts.master')
@section("title") Customers | {{ env('APP_NAME') }} @endsection
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
                <span class="font-weight-bold mr-2">Total Customers</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ $customer_count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a href="{{ route('customer.add') }}">
                    <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2">
                        <b><i class="icon-plus2"></i></b>
                        Add Customer
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form id='customer_filters' action="{{ route('customers') }}" autocomplete="off" method="GET">
        <div class="form-group row template mt-2">
            <div class="col-lg-4">
                <div class="form-group form-group-feedback form-group-feedback-right search-box">
                    <input type="text" class="form-control form-control-lg " placeholder="Search with customer name or mobile" name="squery"
                        value="{{ request('squery') }}">
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
                            <th>Client ID</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Alt. Contact</th>
                            <th>Aadhar</th>
                            <th>PAN</th>
                            <th>GST</th>
                            <th>DOB</th>
                            <th>Anniversary</th>
                            <th>Connection Date</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>
                                <a href="{{ route('customer.edit', $customer->id) }}">{{ $customer->customer_email }}</a>
                            </td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_email }}</td>
                            <td>{{ $customer->customer_address }}</td>
                            <td>{{ $customer->customer_contact_number }}</td>
                            <td>{{ $customer->contact_number_two }}</td>
                            <td>{{ $customer->aadhar_no }}</td>
                            <td>{{ $customer->pan_no }}</td>
                            <td>{{ $customer->gstin_no }}</td>
                            <td>{{ $customer->dob }}</td>
                            <td>{{ $customer->anniversary_date }}</td>
                            <td>{{ $customer->connection_date }}</td>
                            <td>{{ $customer->remarks }}</td>
                            <td><a href="{{ route('customer.delete', $customer->id) }}" class="delete-resource"><i class="icon-trash"></i></a></td>
                            <td>&nbsp;</td>
                        </tr>
                        @endforeach
                        @if (count($customers) == 0)
                        <tr>
                            <td colspan="8" class="text-center">No results found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $customers->appends(request()->except('page'))->links() }}
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
    });
</script>
@endsection
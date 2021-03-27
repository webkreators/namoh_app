@extends('admin.layouts.master')
@section("title") Users | {{ env('APP_NAME') }} @endsection
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
                <span class="font-weight-bold mr-2">Total Invoices</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ $invoices_count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a href="{{ route('invoices.add') }}">
                    <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2">
                        <b><i class="icon-plus2"></i></b>
                        Add Invoice
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form action="" method="GET" _lpchecked="1" id="coupon_list_form">
        <input type="hidden" name="excel_export" value='0' />
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="client_name" class="form-control" placeholder="Search by client name" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" name="date_from" class="form-control datepicker" placeholder="Date From" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" name="date_to" class="form-control datepicker" placeholder="Date To" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="paid_unpaid" class="form-control">
                        <option value="">Payment Status</option>
                        <option value="1">Paid</option>
                        <option value="0">UnPaid</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-icon"><i class="icon-search4"></i></button>
                <button type="button" id='clear_form' class="btn alpha-pink text-pink-800 btn-icon ml-2"><i class="icon-cross3"></i></button>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table invoices-list">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Invoice #</th>
                            <th>Client #</th>
                            <th>Payment</th>
                            <th>Remarks</th>
                            <th>Client</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Bill Details</th>
                            <th>Grand Total</th>
                            <th>Valid From</th>
                            <th>Valid Till</th>
                            <th>Connection Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                        <tr>
                            <td>
                                <a href=""></a>
                            </td>
                            <td></td>
                            <td>{{ $invoice->customer_email }}</td>
                            <td>{{ $invoice->paid_unpaid == 0 ? 'Unpaid' : 'Paid' }}</td>
                            <td>{{ $invoice->remarks }}</td>
                            <td>{{ $invoice->customer_name }}</td>
                            <td>{{ $invoice->customer_contact_number }}</td>
                            <td>{{ $invoice->customer_address }}</td>
                            <td></td>
                            <td>{{ $invoice->grand_total }}</td>
                            <td>{{ $invoice->start_date }}</td>
                            <td>{{ $invoice->end_date }}</td>
                            <td>{{ $invoice->connection_date }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="14" class="text-center">No results found</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3">
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
        $('#excel_export').click(function () {
            form.find("input[name='excel_export']").val(1);
            form.attr('target', '_blank').submit();
            form.removeAttr('target');
            form.find("input[name='excel_export']").val(0);
        });
    });
</script>
@endsection
@extends('admin.layouts.master')
@section("title") Invoices | {{ env('APP_NAME') }} @endsection
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
    <form action="" method="GET" _lpchecked="1" id="invoices_filters">
        <input type="hidden" name="excel_export" value='0' />
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <input value="{{ !empty($filters['client_params']) ? $filters['client_params'] : '' }}" type="text" name="client_params" class="form-control" placeholder="Search by client name/mobile/id" />
                </div>
            </div>
            <!-- <div class="col-md-2">
                <div class="form-group">
                    <input type="text" name="date_from" class="form-control datepicker" placeholder="Date From" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" name="date_to" class="form-control datepicker" placeholder="Date To" />
                </div>
            </div> -->
            <div class="col-md-2">
                <div class="form-group">
                    <select name="paid_unpaid" class="form-control">
                        <option value="">Payment Status</option>
                        <option {{ !empty($filters['paid_unpaid']) && $filters['paid_unpaid'] == 'paid' ? 'selected' : '' }} value="paid">Paid</option>
                        <option {{ !empty($filters['paid_unpaid']) && $filters['paid_unpaid'] == 'unpaid' ? 'selected' : '' }} value="unpaid">UnPaid</option>
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
                            <th>Invoice #</th>
                            <th>Client #</th>
                            <th>Payment</th>
                            <th style="min-width: 250px;">Client Name</th>
                            <th>Grand Total</th>
                            <th>Valid From</th>
                            <th>Valid Till</th>
                            <th>Connection Date</th>
                            <th>Mobile</th>
                            <th style="min-width: 300px;">Address</th>
                            <th>Bill Details</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $key => $invoice)
                        <tr>
                            <td><a href="{{ route('invoices.edit', $invoice->invoice_id) }}">{{ $invoice->invoice_id }}</a></td>
                            <td><a href="{{ route('customer.edit', $invoice->client_id) }}">{{ $invoice->customer_email }}</a></td>
                            <td>{{ $invoice->paid_unpaid == 0 ? 'Unpaid' : 'Paid' }}</td>
                            <td>{{ $invoice->customer_name }}</td>
                            <td>{{ $invoice->grand_total }}</td>
                            <td>{{ $invoice->start_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->start_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $invoice->end_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->end_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $invoice->connection_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->connection_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $invoice->customer_contact_number }}</td>
                            <td>{{ $invoice->customer_address }}</td>
                            <td></td>
                            <td>{{ $invoice->remarks }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        @endforeach
                        @if (count($invoices) == 0)
                        <tr>
                            <td colspan="14" class="text-center">No results found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $invoices->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        var form = $('#invoices_filters');
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
        $('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            yearRange: "2000:c"
        });
    });
</script>
@endsection
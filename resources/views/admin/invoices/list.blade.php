@extends('admin.layouts.master')
@section("title") Invoices | {{ env('APP_NAME') }} @endsection
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
                <span class="font-weight-bold mr-2">Total Invoices</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ $invoices_count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a href="{{ route('invoices.add') }}">
                    <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2">
                        <b><i class="icon-plus2"></i></b>Add Invoice
                    </button>
                </a>
                <button id="excel_export" class="btn bianca-200 mr-2"><i class="icon-file-excel mr-2"></i> Export Invoices</button>
                <button id="pdf_print" class="btn bianca-200 mr-2"><i class="icon-printer mr-2"></i> Print Invoices</button>
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
            <div class="col-md-2">
                <div class="form-group">
                    <input value="{{ !empty($filters['date_from']) ? $filters['date_from'] : '' }}" type="text" name="date_from" class="form-control datepicker" placeholder="Date From" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input value="{{ !empty($filters['date_to']) ? $filters['date_to'] : '' }}" type="text" name="date_to" class="form-control datepicker" placeholder="Date To" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="paid_unpaid" class="form-control">
                        <option value="">Payment Status</option>
                        <option {{ !empty($filters['paid_unpaid']) && $filters['paid_unpaid'] == 'paid' ? 'selected' : '' }} value="paid">Paid</option>
                        <option {{ !empty($filters['paid_unpaid']) && $filters['paid_unpaid'] == 'unpaid' ? 'selected' : '' }} value="unpaid">UnPaid</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 search-icons-box">
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
                            <th>Payment Comment</th>
                            <th>Client Name</th>
                            <th>Grand Total</th>
                            <th>Invoice Date</th>
                            <th>Valid From</th>
                            <th>Valid Till</th>
                            <th>Connection Date</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Bill Details</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $key => $invoice)
                        <tr>
                            <td class="invoice_title">
                            <a class="text" href="{{ route('invoices.edit', $invoice->invoice_id) }}">{{ $invoice->financial_year }}{{ $invoice->invoice_no }}</a>
                            <a class="pdf-img" target="_blank" href="{{ route('invoice.generate', $invoice->invoice_id) }}"><i class="icon-file-pdf"></i></a>
                            </td>
                            <td><a href="{{ route('customer.edit', $invoice->client_id) }}">{{ $invoice->customer_email }}</a></td>
                            <td class="paid_unpaid_show"><span data-url="{{ route('invoices.payment.status', $invoice->invoice_id) }}" class="{{ $invoice->paid_unpaid == 0 ? 'badge badge-danger unpaid-invoice-span' : 'badge paid_text' }}">{{ $invoice->paid_unpaid == 0 ? 'Unpaid' : 'Paid' }}</span></td>
                            <td>{{ $invoice->payment_comment }}</td>
                            <td>{{ $invoice->customer_name }}</td>
                            <td class="outrageous-orange-500"><span style="font-family: Arial;">&#8377;</span>{{ number_format($invoice->grand_total, 2) }}</td>
                            <td>{{ $invoice->invoice_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->invoice_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $invoice->start_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->start_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $invoice->end_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->end_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $invoice->connection_date != NULL ? \Carbon\Carbon::CreateFromFormat('Y-m-d', $invoice->connection_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $invoice->customer_contact_number }}</td>
                            <td class="view_tab"><span style="cursor: pointer;" class='client-address' data-address='{{ $invoice->customer_address }}'>view</span></td>
                            <td>&nbsp;</td>
                            <td>{{ $invoice->remarks }}</td>
                            <td class="text-center">
                            <a href="{{ route('invoices.delete', $invoice->invoice_id) }}" class="delete-resource"><i class="icon-trash"></i></a>
                            <!-- <a target="_blank" href="{{ route('invoice.generate', $invoice->invoice_id) }}"><i class="icon-file-pdf"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                        @if (count($invoices) == 0)
                        <tr>
                            <td colspan="14" class="text-center">No results found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-4">
                  {{ $invoices->appends(request()->except('page'))->links() }}
              </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card border-left-3 border-left-success rounded-left-0">
                        <div class="card-body">
                            <div class="row text-center justify-content-center">
                                <div class="col-2">
                                    <h5 class="font-weight-semibold mb-0"><span style="font-family: Arial;">&#8377;</span>{{ number_format($paid_amount, 2) }}</h5>
                                    <span class="text-muted font-size-sm">Paid Amount</span>
                                </div>
                                <div class="col-2">
                                    <h5 class="font-weight-semibold mb-0"><span style="font-family: Arial;">&#8377;</span>{{ number_format($unpaid_amount, 2) }}</h5>
                                    <span class="text-muted font-size-sm">UnPaid Amount</span>
                                </div>
                                <div class="col-2">
                                    <h5 class="font-weight-semibold mb-0"><span style="font-family: Arial;">&#8377;</span>{{ number_format($gross_amount, 2) }}</h5>
                                    <span class="text-muted font-size-sm">Gross Amount</span>
                                </div>
                                <div class="col-2">
                                    <h5 class="font-weight-semibold mb-0"><span style="font-family: Arial;">&#8377;</span>{{ number_format($gst_amt, 2) }}</h5>
                                    <span class="text-muted font-size-sm">GST Amount</span>
                                </div>
                                <div class="col-2">
                                    <h5 class="font-weight-semibold mb-0"><span style="font-family: Arial;">&#8377;</span>{{ number_format($paid_amount + $unpaid_amount, 2) }}</h5>
                                    <span class="text-muted font-size-sm">Grand Total</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="invoicePaymentStatusModal" class="modal fade" tabindex="-1"></div>
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
        $('#pdf_print').click(function() {
            form.attr('action', '{{ route("invoices.bulk.generate") }}');
            form.attr('target', '_blank').submit();
            form.removeAttr('target');
            form.attr('action', '');
        });
        $('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
            changeYear: true,
            yearRange: "2000:c"
        });
        $('.client-address').click(function() {
            swal($(this).data('address'));
        });
        $('.delete-resource').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "You are about to delete an invoice",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    location.href = link;
                }
            });
        });
        $('.unpaid-invoice-span').click(function() {
            var span = $(this);
            $.ajax({
                url: span.data('url'),
                dataType: 'json',
                success: function(data) {
                    $('#invoicePaymentStatusModal').html(data.html).modal('show');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $(document).on('submit', '#invoice_payment_form', function(e) {
            e.preventDefault();
            var action = $('#invoice_payment_form').attr('action');
            $.ajax({
                data: $('#invoice_payment_form').serialize(),
                type: "PUT",
                url: action,
                success: function(data) {
                    $('#invoicePaymentStatusModal').modal('hide');
                    location.reload();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection
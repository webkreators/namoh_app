@extends('admin.layouts.master')
@section("title") Add Invoice | {{ env('APP_NAME') }} @endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Add New Invoice</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('invoice.store') }}" method="post" class="custom-form">
                @csrf
                <input type="hidden" name="financial_year" value="{{ $financial_year }}" />
                <input type="hidden" name="invoice_no" value="{{ $invoice_no }}" />
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="invoiceNumber" class="form-label">Invoice Number</label>
                        <input value="{{ $invoice_number }}" type="text" readonly class="form-control" id="invoiceNumber" name="invoiceNumber" placeholder="Invoice Number">
                    </div>
                    <div class="col-lg-6">
                        <label for="invoice_date" class="form-label">Invoice Date</label>
                        <input type="text" class="form-control" id="invoice_date" name="invoice_date">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="First client Name" class="form-label">Firm/Client Name</label>
                        <select class="form-control select2" id="client_id" name="client_id">
                            <option value="">Select Client</option>
                            @foreach ($customers as $customer)
                            <option data-connection-date="{{ Carbon\Carbon::CreateFromFormat('Y-m-d', $customer->connection_date)->format('d/m/Y') }}" data-number="{{ $customer->customer_contact_number }}" data-address="{{ $customer->customer_address }}" value="{{ $customer->client_id }}">{{ $customer->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="client_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="client_number" placeholder="Client Contact" />
                    </div>
                    <div class="col-md-4">
                        <label for="client_address" class="form-label">Client Address</label>
                        <input type="text" class="form-control" id="client_address" name="client_address">
                    </div>
                </div>
                <legend class="font-weight-semibold font-size-md text-uppercase mt-1 mb-1" style="border-bottom: none;">
                    Invoice Items:
                </legend>
                <div class="invoice-items">
                    <div class="form-group row invoice-item invoice-item-template">
                        <div class="col-lg-6">
                            <label class="col-form-label" for="">Service Name:</label>
                            <select name="item_id[]" class="form-control invoice-item-name">
                                <option value="">-Select Service-</option>
                                @foreach ($services as $service)
                                <option data-charge="{{ $service->product_charge }}" value="{{ $service->product_id }}">{{ $service->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-5">
                            <label class="col-form-label">Amount:</label>
                            <input type="text" readonly class="form-control invoice-item-price" name="item_price[]" placeholder="Service amount">
                        </div>
                        <div class="col-lg-1">
                            <label class="col-form-label" style="width: 100%;">&nbsp;</label>
                            <button type="button" class="btn btn-danger hidden remove-invoice-row"><i class="icon-trash ml-1"></i></i></button>
                        </div>
                    </div>
                </div>
                <div class="text-left mt-3 mb-2">
                    <button type="button" class="btn alpha-blue text-blue-800 border-blue-600 legitRipple add-new-item">Add Item<i class="icon-plus22 ml-1"></i></button>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="Gross Amount" class="form-label">Gross Amount</label>
                        <input readonly type="text" class="form-control" id="gross_amount" name="total_amount" />
                    </div>
                    <div class="col-lg-4">
                        <label for="Discount" class="form-label">Discount</label>
                        <input type="text" class="form-control" id="discount" name="discount">
                    </div>
                    <div class="col-lg-4">
                        <label for="Discount" class="form-label">Discount Type</label>
                        <select name="discount_type" class="form-control discount-type">
                            <option value="">-Select Item-</option>
                            <option value="Percentage">Percentage</option>
                            <option value="Fixed Amount">Fixed Amount</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="tax_slab" class="form-label">GST Tax Slab</label>
                        <select class="form-control" id="tax_slab" name="tax_slab">
                            <option selected data-percentage="0" value="0">Select Tax Slab</option>
                            @foreach ($tax_slabs as $tax_slab)
                            <option data-percentage="{{ $tax_slab->tax_per }}" value="{{ $tax_slab->id }}">{{ $tax_slab->slab_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="Grand Total" class="form-label">Grand Total</label>
                        <input readonly type="text" class="form-control" id="grand_total" name="grand_total" />
                    </div>
                    <div class="col-md-4">
                        <label for="Connection Date" class="form-label">Connection Date</label>
                        <input type="text" class="form-control" id="connection_date" name="connection_date" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="Service Time" class="form-label">Service Time</label>
                        <select class="form-control" name="service_time" id="service_time">
                            <option selected value="">Select Service Time</option>
                            @foreach (\App\Models\Service::$plans as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="From Date" class="form-label">From Date</label>
                        <input type="text" class="form-control" id="start_date" name="start_date" />
                    </div>
                    <div class="col-md-3">
                        <label for="To Date" class="form-label">To Date</label>
                        <input type="text" class="form-control" id="end_date" name="end_date" />
                    </div>
                    <div class="col-md-3">
                        <label for="To Date" class="form-label">Invoice Pay Status</label>
                        <select class="form-control" name="paid_unpaid">
                            <option selected value="">Select Payment Status</option>
                            <option value="1">Paid</option>
                            <option value="0">Unpaid</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label for="Remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" placeholder="Leave a comment here" id="remarks" name="remarks" style="height: 100px"></textarea>
                    </div>
                </div>
                <div class="text-left mt-3 mb-2">
                    <button type="submit" class="btn btn-primary">Create New Invoice<i class="icon-database-insert ml-1"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('#invoice_date, #start_date, #end_date').datepicker({
            dateFormat: 'dd/mm/yy'
        });
        $("#client_id").change(function() {
            var number = $(this).find(':selected').data('number');
            var address = $(this).find(':selected').data('address');
            var connection_date = $(this).find(':selected').data('connection-date');
            $("#client_number").val(number); 
            $("#client_address").val(address);
            $("#connection_date").val(connection_date);
        });
        $('.add-new-item').click(function() {
            var item_row = $('.invoice-item-template').clone();
            item_row.removeClass('invoice-item-template');
            item_row.find('.remove-invoice-row').removeClass('hidden');
            item_row.find('.invoice-item-price').val('');
            $('.invoice-items').append(item_row);
            calculateGrossAmount();
        });
        $(document).on('change', '.invoice-item-name', function() {
            var price = $(this).find(':selected').data('charge');
            var row = $(this).closest('.invoice-item');
            row.find('.invoice-item-price').val(price);
            calculateGrossAmount();
        });
        $('#discount').keyup(function() {
            calculateGrossAmount();
        });
        $('#tax_slab, .discount-type').change(function() {
            calculateGrossAmount();
        });
        $(document).on('click', '.remove-invoice-row', function() {
            $(this).closest('.invoice-item').remove();
            calculateGrossAmount();
        });
        var grossAmount = 0;
        function calculateGrossAmount() {
            var sum = 0, afterDiscount = 0, discount = 0, itemPrice = 0;
            $('.invoice-item-price').each(function(item) {
                itemPrice = $(this).val();
                if (itemPrice == '') itemPrice = 0;
                sum += parseFloat(itemPrice);
            });
            $('#gross_amount').val(sum);
            discount = $("#discount").val();
            var taxSlabPercentage = $("#tax_slab").find(':selected').data('percentage');
            console.log("Tax Slab", taxSlabPercentage);
            var discountType = $(".discount-type").val();
            if (discount == "") discount = 0;
            afterDiscount = sum;
            if (discountType == "Percentage") {
                var dis = parseFloat(sum) * parseFloat(discount) / 100;
                afterDiscount = parseFloat(sum) - parseFloat(dis);
            }
            if (discountType == "Fixed Amount") {
                var dis = discount;
                afterDiscount = parseFloat(sum) - parseFloat(discount);
            }
            console.log("After Discount ", afterDiscount);
            var tax_rupee = parseFloat(afterDiscount) * parseFloat(taxSlabPercentage) / 100;
            console.log("Tax Rupee", tax_rupee);
            var grand_total = parseFloat(afterDiscount) + parseFloat(tax_rupee);
            $("#total").val(sum.toFixed(2));
            if (sum == 0) {
                grand_total = 0;
            }
            $('#grand_total').val(grand_total.toFixed(2)); 
        }
        
        $('#service_time, #invoice_date').change(function() {
            calculateFromToDate();
        });

        function calculateFromToDate() {
            var invoiceDate = $('#invoice_date').val();
            var serviceTime = $('#service_time').val();
            if (invoiceDate == '' || serviceTime == '') return;
            $.ajax({
                url: "{{ route('invoice.connection.dates') }}",
                type: "GET",
                data: { plan: serviceTime, invoice_date: invoiceDate },
                success: function(data) {
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                }
            });
        }
    });
</script>
@endsection
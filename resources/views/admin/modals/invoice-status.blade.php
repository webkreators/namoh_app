<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><span class="font-weight-bold">Invoice Payment Status</span></h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="invoice_payment_form" method="POST" action="{{ route('invoices.payment.updates', $invoice->invoice_id) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Payment Status:</label>
                    <div class="col-lg-8">
                        <select name="paid_unpaid" id="paid_unpaid" class='form-control'>
                            <option selected value="">Select Payment Status</option>
                            <option value="1" {{ $invoice->paid_unpaid == 1 ? 'selected' : '' }}>Paid</option>
                            <option value="0" {{ $invoice->paid_unpaid == 0 ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label"><span class="text-danger">*</span>Payment Remarks:</label>
                    <div class="col-lg-8">
                        <textarea type="text" class="form-control" name="payment_comment" placeholder="Payment Remarks">{{ $invoice->payment_comment }}</textarea>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update<i class="icon-database-insert ml-1"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
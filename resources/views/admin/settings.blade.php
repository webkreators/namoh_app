@extends('admin.layouts.master')
@section("title") Settings | {{ env('APP_NAME') }}
@endsection
@section('content')
<style>
    .disable-switch {
        opacity: 0.5;
        pointer-events: none;
    }
</style>
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">SETTINGS</span>
            </h4>
        </div>
    </div>
</div>
<div class="content">
    <div class="col-md-12">
        <div class="card" style="min-height: 100vh;">
            <div class="card-body">
                <div class="d-lg-flex justify-content-lg-left">
                    <ul class="nav nav-pills flex-column mr-lg-3 wmin-lg-250 mb-lg-0">
                        <li class="nav-item">
                            <a href="#termsSettings" class="nav-link active" data-toggle="tab">
                                <i class="icon-gear mr-2"></i>
                                Terms &amp; Conditions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#bankSettings" class="nav-link" data-toggle="tab">
                                <i class="icon-wallet mr-2"></i>
                                Bank Details
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="width: 100%; padding: 0 25px;">
                        <div class="tab-pane fade show active" id="termsSettings">
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                Terms &amp; Conditions
                            </legend>
                            <form action="{{ route('settings.update') }}" method="POST">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Term Name:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="storeName" value="{{ config('settings.storeName') }}" placeholder="Enter T&C">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">&nbsp;</label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-primary btn-md btn-labeled btn-labeled-left mr-2" id="toggleSendTestEmail" autocomplete="false"><b><i class="icon-plus2"></i></b> Add Term </button>
                                    </div>
                                </div>
                            </form>
                            <hr style="border-top: 3px dashed rgba(103, 58, 183, 0.20) !important;">
                            <div class="form-group row">
                                <label class="col-lg-12 col-form-label"><strong>List Terms &amp; Conditions</strong></label>
                                <div class="col-lg-12">
                                    <ul class="list-group">
                                        <li class="list-group-item">Cras justo odio</li>
                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                        <li class="list-group-item">Morbi leo risus</li>
                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="bankSettings">
                            <legend class="font-weight-semibold text-uppercase font-size-sm">
                                Bank Details
                            </legend>
                            <form action="{{ route('settings.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Beneficiary Name:</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="beneficiary_name" value="{{ $bank_details->beneficiary_name }}" placeholder="Beneficiary Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Bank Name:</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="bank_name" value="{{ $bank_details->bank_name }}" placeholder="Bank Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Account No:</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="account_no" value="{{ $bank_details->account_no }}" placeholder="Account No">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Branch:</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="branch" value="{{ $bank_details->branch }}" placeholder="Branch">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">IFSC Code:</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="ifsc_code" value="{{ $bank_details->ifsc_code }}" placeholder="IFSC Code">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">&nbsp;</label>
                                    <div class="col-lg-9">
                                        <button style="margin-top: 10px;" type="submit" class="btn btn-primary btn-md" id="toggleSendTestEmail" autocomplete="false"> Update Information <i class="icon-database-edit2 ml-1"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function () {
        $('.form-control-uniform').uniform();
        /* Navigate with hash */
        var hash = window.location.hash;
        $("[name='window_redirect_hash']").val(hash);
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        $('.nav-pills a').click(function (e) {
            $(this).tab('show');
            // var scrollmem = $('body').scrollTop();
            // window.location.hash = this.hash;
            // $("[name='window_redirect_hash']").val(this.hash);
            // $('html, body').scrollTop(scrollmem);
        });
    });
</script>
@endsection
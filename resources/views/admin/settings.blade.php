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
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-lg">
                            <b><i class="icon-database-insert ml-1"></i></b>
                            Save Settings
                        </button>
                    </div>
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
                                    <i class="icon-brush mr-2"></i>
                                    Bank Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#accountSettings" class="nav-link" data-toggle="tab">
                                    <i class="icon-truck mr-2"></i>
                                    Account Settings
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" style="width: 100%; padding: 0 25px;">
                            <div class="tab-pane fade show active" id="termsSettings">
                                <legend class="font-weight-semibold text-uppercase font-size-sm">
                                    Terms &amp; Conditions
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Term Name:</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="storeName"
                                            value="{{ config('settings.storeName') }}" placeholder="Enter T&C">
                                        <button style="margin-top: 10px;" type="button" class="btn btn-secondary btn-sm"
                                            id="toggleSendTestEmail" autocomplete="false"> Add Term</button>
                                    </div>
                                </div>
                                <hr style="border-top: 3px dashed rgba(103, 58, 183, 0.20) !important;">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label"><strong>List
                                            Terms &amp; Conditions</strong></label>
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
                                    SEO Settings
                                </legend>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Meta Title: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="seoMetaTitle"
                                            value="{{ config('settings.seoMetaTitle') }}" placeholder="Meta Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Meta Description: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg"
                                            name="seoMetaDescription"
                                            value="{{ config('settings.seoMetaDescription') }}"
                                            placeholder="Meta Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Open Graph Title: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="seoOgTitle"
                                            value="{{ config('settings.seoOgTitle') }}" placeholder="Open Graph Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Open Graph Description:
                                        </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="seoOgDescription"
                                            value="{{ config('settings.seoOgDescription') }}"
                                            placeholder="Open Graph Meta Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if(config('settings.seoOgImage') !== NULL)
                                    <div class="col-lg-9 offset-lg-3">
                                        <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/assets/img/social/{{ config('settings.seoOgImage') }}"
                                            alt="Open Graph Image" class="img-fluid mb-2" style="width: 30%;">
                                    </div>
                                    @endif
                                    <label class="col-lg-3 col-form-label"><strong>Open Graph Image: </strong></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control-uniform" name="seoOgImage" data-fouc>
                                        <span class="help-text text-muted">Image size 1200x630 </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Twitter Cards Title:
                                        </strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg" name="seoTwitterTitle"
                                            value="{{ config('settings.seoTwitterTitle') }}"
                                            placeholder="Twitter Cards Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><strong>Twitter Cards
                                            Description</strong></label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-lg"
                                            name="seoTwitterDescription"
                                            value="{{ config('settings.seoTwitterDescription') }}"
                                            placeholder="Twitter Cards Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if(config('settings.seoTwitterImage') !== NULL)
                                    <div class="col-lg-9 offset-lg-3">
                                        <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/assets/img/social/{{ config('settings.seoTwitterImage') }}"
                                            alt="Twitter Image" class="img-fluid mb-2" style="width: 30%;">
                                    </div>
                                    @endif
                                    <label class="col-lg-3 col-form-label"><strong>Twitter Cards Image:
                                        </strong></label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control-uniform" name="seoTwitterImage"
                                            data-fouc>
                                        <span class="help-text text-muted">Image size 600x335</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf">
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary btn-labeled btn-labeled-left btn-lg">
                            <b><i class="icon-database-insert ml-1"></i></b>
                            Save Settings
                        </button>
                    </div>
                    <input type="hidden" name="window_redirect_hash" value="">
                </form>
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
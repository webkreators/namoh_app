@extends('admin.layouts.master')
@section("title")
Dashboard
@endsection
@section('content')
<div class="content mb-5">
    <div id="update_notification" style="display:none;" class="alert alert-update mt-2">
        <button type="button" style="margin-left: 20px" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="row mt-4">
        <div class="col-6 col-xl-3 mb-2 mt-2">
            <div class="col-xl-12 dashboard-display p-3">
                <a class="block block-link-shadow text-left" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-right mt-10 d-none d-sm-block">
                            <i class="dashboard-display-icon icon-users"></i>
                        </div>
                        <div class="dashboard-display-number">{{ $customer_counts }}</div>
                        <div class="font-size-sm text-uppercase text-muted">Customers</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
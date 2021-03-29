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
                <span class="font-weight-bold mr-2">TOTAL USERS</span>
                <span class="badge badge-primary badge-pill animated flipInX">{{ $users_count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements d-none py-0 mb-3 mb-md-0">
            <div class="breadcrumb">
                <a href="{{ route('user.add') }}">
                    <button type="button" class="btn btn-secondary btn-labeled btn-labeled-left mr-2">
                        <b><i class="icon-plus2"></i></b>
                        Add User
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <form id='user_filters' action="{{ route('users') }}" autocomplete="off" method="GET">
        <div class="form-group row template mt-2">
            <div class="col-lg-4">
                <div class="form-group form-group-feedback form-group-feedback-right search-box">
                    <input type="text" class="form-control form-control-lg " placeholder="Search with user name or mobile" name="squery"
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
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>UserName</th>
                            <th>Aadhar</th>
                            <th>Designation</th>
                            <th>User Type</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <a href="{{ route('user.edit', $user->login_id) }}">{{ $user->company_name }}</a>
                            </td>
                            <td>{{ $user->company_mobile }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->aadhar_card_no }}</td>
                            <td>{{ $user->designation }}</td>
                            <td>{{ $user->user_type == 1 ? 'Admin' : 'Manager' }}</td>
                            <td><span class="badge badge-flat border-grey-800 text-default text-capitalize">{{ $user->status == 0 ? 'Yes' : 'No' }}</span></td>
                            <td><a href="{{ route('user.delete', $user->login_id) }}" class="delete-resource"><i class="icon-trash"></i></a></td>
                        </tr>
                        @endforeach
                        @if (count($users) == 0)
                        <tr>
                            <td colspan="8" class="text-center">No results found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $users->appends(request()->except('page'))->links() }}
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
        $('.delete-resource').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "You are about to delete user",
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
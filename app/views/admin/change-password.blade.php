@extends('admin.layouts.main')

@section('content')

    <section class="content-header">
        <h1>
            Users
            <small>Change password</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::route('admin-home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
    </section>

    <section class="content">
        <div class="col-md-6">
            <form class="white-row" method="post" action="{{ URL::route('admin-change-password-post') }}">

                <div class="row">
                    <div class="form-group @if($errors->has('old_password')) has-error has-feedback @endif">
                        <div class="col-md-12">
                            <label for="old_password">Old password</label>
                            <input type="password" id="old_password" name="old_password" class="form-control" required="required">
                            @if($errors->has('old_password')) <label class="control-label">{{ $errors->first('old_password') }}</label> @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group @if($errors->has('new_password')) has-error has-feedback @endif">
                        <div class="col-md-12">
                            <label for="new_password">New password</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required="required">
                            @if($errors->has('new_password')) <label class="control-label">{{ $errors->first('new_password') }}</label> @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group @if($errors->has('re-enter_new_password')) has-error has-feedback @endif">
                        <div class="col-md-12">
                            <label for="re-enter_new_password">Re-enter new password</label>
                            <input type="password" id="re-enter_new_password" name="re-enter_new_password" class="form-control" required="required">
                            @if($errors->has('re-enter_new_password')) <label class="control-label">{{ $errors->first('re-enter_new_password') }}</label> @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary margin pull-right">Change password</button>
                    </div>
                </div>

            </form>

        </div>


        <div class="clearfix"></div>

    </section>
@stop

@section('scripts')

@stop




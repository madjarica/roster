@extends('admin.layouts.main')

@section('content')

<section class="content-header">
    <h1>
        Users
        <small>New user</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin-home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
    </ol>
</section>

<section class="content">
    <form action="{{ URL::route('admin-add-user-post') }}" method="post" enctype="multipart/form-data" files="true" accept-charset="utf-8">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <div class="form-group @if($errors->has('user_type')) has-error has-feedback @endif">
                    <label for="user_type">Type of User</label>
                    <select name="user_type" id="user_type" class="form-control">
                        <option value="1">Administrator</option>
                        <option value="2">Editor</option>
                        <option value="3">Viewer</option>
                    </select>
                    @if($errors->has('user_type')) <label class="control-label">{{ $errors->first('user_type') }}</label> @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group @if($errors->has('email')) has-error has-feedback @endif">
                    <label for="email">User Email</label>
                    <input type="email" name="email" id="email" class="form-control" required value="{{ Input::old('email') }}">
                    @if($errors->has('email')) <label class="control-label">{{ $errors->first('email') }}</label> @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <div class="form-group @if($errors->has('first_name')) has-error has-feedback @endif">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" required value="{{ Input::old('first_name') }}">
                    @if($errors->has('first_name')) <label class="control-label">{{ $errors->first('first_name') }}</label> @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group @if($errors->has('last_name')) has-error has-feedback @endif">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" required value="{{ Input::old('last_name') }}">
                    @if($errors->has('last_name')) <label class="control-label">{{ $errors->first('last_name') }}</label> @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <label>Profile image</label>
                <input type="file" class="" name="image">
            </div>
            <div class="col-md-4">

            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-primary margin pull-right">Add user</button>
        </div>

    </form>

    <div class="clearfix"></div>

</section>
@stop

@section('scripts')

@stop




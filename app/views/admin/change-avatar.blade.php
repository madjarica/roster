@extends('admin.layouts.main')

@section('content')

    <section class="content-header">
        <h1>
            Users
            <small>Change profile image</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::route('admin-home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
    </section>

    <section class="content">
        <div class="col-md-6">
            <form method="POST" action="{{ URL::route('admin-upload-avatar-post') }}" accept-charset="UTF-8" class="" role="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group">
                        @if($user->profile_image != '')
                            <img style="display: block; float: left;" src="{{ $user->profile_image }}" width="300" alt="" class="img-thumbnail"/>
                        @else
                            <img style="display: block; float: left;" src="/img/avatars/default.jpg" width="300" alt="" class="img-thumbnail"/>
                        @endif

                        <hr class="no-lines"/>
                    </div>
                </div>
                <div class="row">
                    <input type="file" class="" name="image">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary margin pull-right" data-loading-text="Loading...">Upload</button>
                </div>
            </form>
        </div>

        <div class="clearfix"></div>

    </section>
@stop

@section('scripts')

@stop




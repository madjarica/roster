@extends('admin.layouts.main')

@section('content')

<section class="content-header">
    <h1>
        Users
        <small>view users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin-home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="users-list" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Type of user</th>
                            <th style="width: 15%;">View user</th>
                            <th style="width: 15%;">Delete user</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th>{{ $user->email }}</th>
                                <th>{{ $user->first_name }}</th>
                                <th>{{ $user->last_name }}</th>
                                <th>@if($user->group == 1) Administrator @elseif($user->group == 2) Editor @else Viewer @endif</th>
                                <th><a href="{{ URL::route('admin-view-user', array('id' => $user->id)) }}" class="btn btn-primary" style="display: block; margin: 0 auto;">Edit {{ $user->username }}'s profile</a></th>
                                <th class="name_{{ $user->id }}"><a href="#" onclick="return makeSureDeleteUser({{ $user->id }})" class="btn btn-danger" style="display: block; margin: 0 auto;">Delete {{ $user->username }}</a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@section('scripts')
<script>
    function makeSureDeleteUser(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            deleteUser(id);
            return true;
        }
        else {
            return false;
        }
    }

    function deleteUser(id) {
        var parent = $('.name_' + id).parent();

        $.ajax({
            type: "get",
            url: "delete-user/" + id,
            data: "",

            success: function() {
                parent.css("display", "none");
            }
        })
    }

    $("#users-list").DataTable();
</script>
@stop
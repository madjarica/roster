@extends('admin.layouts.main')

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Jobs
        <small>View jobs</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin-home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jobs</li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="jobs-list" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Job Start</th>
                            <th>Job End</th>
                            <th>Job Start Display</th>
                            <th>Job End Display</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>P11</th>
                            <th>Additional file</th>
                            <th>Highlighted</th>
                            <th style="width: 5%;">View user</th>
                            <th style="width: 5%;">Delete user</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <th>{{ JobType::where('job_type_slug', $job->job_type)->first()->job_type }}</th>
                                <th>{{ $job->job_name }}</th>
                                <th>{{ $job->job_start }}</th>
                                <th>{{ $job->job_end }}</th>
                                <th>{{ $job->job_display_start }}</th>
                                <th>{{ $job->job_display_end }}</th>
                                <th>{{ $job->location }}</th>
                                <th><button type="button" class="btn btn-primary" data-toggle="popover" title="Job info" data-content="{{ substr(strip_tags($job->job_information), 0, 800) }}...">Expand</button></th>
                                <th>@if($job->p11 != '') <a href="{{ URL::route('home') }}/{{ $job->p11 }}" target="_blank">Download</a> @else No file @endif</th>
                                <th>@if($job->additional_file != '') <a href="{{ URL::route('home') }}/{{ $job->additional_file }}" target="_blank">Download</a> @else No file @endif</th>
                                <th>@if($job->highlighted == 1) YES @else NO @endif</th>
                                <th><a href="{{ URL::route('admin-view-job', $job->id) }}" class="btn btn-primary" style="display: block; margin: 0 auto;">Edit Job</a></th>
                                <th class="name_{{ $job->id }}"><a href="#" onclick="return makeSureDeleteJob({{ $job->id }})" class="btn btn-danger" style="display: block; margin: 0 auto;">Delete Job</a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</section>
@stop

@section('scripts')
    <script>
        function makeSureDeleteJob(id) {
            if (confirm("Are you sure you want to delete this job?")) {
                deleteJob(id);
                return true;
            }
            else {
                return false;
            }
        }

        function deleteJob(id) {
            var parent = $('.name_' + id).parent();

            $.ajax({
                type: "get",
                url: "delete-job/" + id,
                data: "",

                success: function() {
                    parent.css("display", "none");
                }
            })
        }

        $("#jobs-list").DataTable();
        $('[data-toggle="popover"]').popover();
    </script>
@stop
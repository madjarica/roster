@extends('all.layouts.main')

@section('content')

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            @if(!$jobs->count())
                <h1 class="page-header">Sorry, that job doesn't exists.</h1>
                <hr>
            @else
                <?php $job = $jobs->first(); ?>

                    <h1 class="page-header">
                        {{ $job->job_name }}
                    </h1>

                    @if($job->p11 != '')
                        <div class="row" style="padding-right: 20px;">
                            <p class="text-right"><a href="{{ URL::route('home') }}/{{ $job->p11 }}" target="_blank">P11 Download</a></p>
                        </div>
                    @endif

                    @if($job->additional_file != '')
                        <div class="row" style="padding-right: 20px;">
                            <p class="text-right"><a href="{{ URL::route('home') }}/{{ $job->additional_file }}" target="_blank">Additional File Download</a></p>
                        </div>
                    @endif

                    @if($job->p11 != '' || $job->additional_file != '')
                        <hr>
                    @endif

                    <p class="lead">
                        category <a href="">{{ $job->job_type }}</a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $job->created_at }}</p>

                    <div class="row">
                        <div class="col-md-6">
                            <b>Start date: </b>{{ $job->job_start }}
                        </div>
                        <div class="col-md-6">
                            <b>End date: </b>{{ $job->job_end }}
                        </div>
                    </div>
                    <p><b>Location: </b>{{ $job->location }}</p>
                    {{ $job->job_information }}
                    <div class="row"><a class="btn btn-primary pull-right" href="{{ URL::route('apply-job', $job->id) }}">Apply now</a></div>
                    <div class="clearfix"></div>

            @endif

        </div>

        @include('all.includes.widgets')

    </div>

@stop
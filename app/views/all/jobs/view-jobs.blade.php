@extends('all.layouts.main')

@section('content')

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Jobs Listing
                <br><small>{{ JobType::where('job_type_slug', $category)->first()->job_type }}</small>
            </h1>

            {{--Jobs listing--}}

            @if(!$jobs->count())
                <h4>We currently don’t have any jobs available in this area. Please check back regularly, as we frequently post new jobs. In the mean time, you can check out the <a href="{{ URL::route('home') }}">jobs we have available in other areas.</a></h4>
            @else

                @foreach($jobs as $job)
                    <h2>
                        <a href="{{ URL::route('view-job', $job->id) }}">{{ $job->job_name }}</a>
                    </h2>
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
                    {{ trim(substr($job->job_information, 0, 200)) }}... <a href="{{ URL::route('view-job', $job->id) }}">Read More</a>
                    <div class="row"><a class="btn btn-primary pull-right" href="{{ URL::route('apply-job', $job->id) }}">Apply now</a></div>
                    <div class="clearfix"></div>
                    <hr>
                    @endforeach
                @endif

                            <!-- Pager -->
                    <ul class="pager">
                        {{ $jobs->links() }}
                    </ul>

        </div>

        @include('all.includes.widgets')

    </div>
    <!-- /.row -->

@stop
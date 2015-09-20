@extends('all.layouts.main')

@section('content')

<div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Jobs Listing
            </h1>

            <b>Purpose of the Positions</b>

            <p>If you are a passionate and committed professional and want to make a lasting difference for children, the world’s leading children’s rights organization would like to hear from you. UNICEF in Serbia welcomes expressions of interest from experts who are interested in becoming members of its recruitment database, in the following key areas: education, early childhood development, child protection, child rights monitoring. The purpose of this database is to assist in identifying prospective external candidates for individual consultanciesin Serbia. All candidates screened for the database must meet the basic UNICEF eligibility requirements:  an advanced university degree from an accredited academic institution; relevant work experienceand proficiency in English and Serbian.</p>

            <b>Competencies of Successful Candidate</b>

            <p>Any candidate to the UNICEF’s database should be:
            <ul>
                <li>Able to communicate effectively to varied audiences, including formal public speaking;</li>
                <li>Able to work effectively in a multi-cultural environment;</li>
                <li>Able to work with different stakeholder from government institutions, academia and NGOs;</li>
                <li>Able to analyse and integrate diverse and complex quantitative and qualitative data from a wide range of sources;</li>
                <li>Able to produce high quality reports and presentations;</li>
                <li>Able to demonstrate, apply and share evidence derived from research;</li>
                <li>Adopt a flexible attitude and adaptability to rapidly changing circumstances;</li>
                <li>Computer literate; and</li>
                <li>Fluent in English and Serbian.</li>
            </ul>
            </p>

            <hr>

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
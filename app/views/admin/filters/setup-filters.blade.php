@extends('admin.layouts.main')

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Filters
        <small>Setup filters</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin-home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Filters</li>
    </ol>
</section>

<section class="content">
    <form action="{{ URL::route('admin-setup-filters-post') }}" method="post" accept-charset="utf-8">

    @foreach($jobs as $job)

        <?php
            $applications = Application::where('job_id', $job->id)->get();
            $filters = [];

            foreach($applications as $application) {
                $array = json_decode($application->data);
                foreach($array as $element) {
                    $decoded_element = json_decode($element);
                    array_push($filters, $decoded_element->label);
                }
            }

            $filters = array_unique($filters);
            $list_of_filters = '';
            $filters_check = Filter::select('filters')->where('job_id', $job->id)->get();
            if($filters_check->count()) {
                $list_of_filters = $filters_check->first()->filters;
            }

        ?>

            <div class="row">
                <div class="col-md-12">
                    <h4>{{ $job->job_name }}</h4>
                    @if(!empty($filters))
                        @foreach($filters as $filter)
                            <label class="checkbox-inline">
                                <input type="checkbox" value="{{ $filter }}" name="filters_{{ $job->id }}[]" @if(strpos($list_of_filters, $filter) !== false) {{ 'checked' }} @endif> {{ $filter }}
                            </label>
                        @endforeach
                    @else
                        <h5>No applications has been posted for this job.</h5>
                    @endif
                </div>
            </div>
    @endforeach

    <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-primary margin pull-right">Save filters</button>
        </div>
    </div>
</form>

    <div class="clearfix"></div>

</section>
@stop

@section('scripts')

@stop


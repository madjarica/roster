@extends('admin.layouts.main')

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Jobs
        <small>New job offer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::route('admin-home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jobs</li>
    </ol>
</section>

<section class="content">

    <form action="{{ URL::route('admin-view-job-post', $job->id) }}" method="post" enctype="multipart/form-data" files="true">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group @if($errors->has('job_type')) has-error has-feedback @endif">
                    <label for="job_type">Type of Job</label>
                    <select name="job_type" id="job_type" class="form-control">
                        @foreach($job_types as $job_type)
                            <option value="{{ $job_type->job_type_slug }}" @if($job->job_type == $job_type->job_type_slug) selected @endif>{{ $job_type->job_type }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('job_type')) <label class="control-label">{{ $errors->first('job_type') }}</label> @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group @if($errors->has('job_name')) has-error has-feedback @endif">
                    <label for="job_name">Job name</label>
                    <input type="text" name="job_name" id="job_name" class="form-control" required value="{{ $job->job_name }}">
                    @if($errors->has('job_name')) <label class="control-label">{{ $errors->first('job_name') }}</label> @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group @if($errors->has('job_start')) has-error has-feedback @endif">
                    <label for="job_start">Job start date</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="job_start" name="job_start" value="{{ $job->job_start }}">
                        @if($errors->has('job_start')) <label class="control-label">{{ $errors->first('job_start') }}</label> @endif
                    </div><!-- /.input group -->
                    <small>The date that the job starts. For positions available immediately, leave blank.</small>
                </div><!-- /.form group -->
            </div>

            <div class="col-md-3">
                <div class="form-group @if($errors->has('job_end')) has-error has-feedback @endif">
                    <label for="job_end">Job end date</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="job_end" name="job_end" value="{{ $job->job_end }}">
                        @if($errors->has('job_end')) <label class="control-label">{{ $errors->first('job_end') }}</label> @endif
                    </div><!-- /.input group -->
                    <small>The date that the job ends. For ongoing positions, leave blank.</small>
                </div><!-- /.form group -->
            </div>

            <div class="col-md-3">
                <div class="form-group @if($errors->has('job_display_start')) has-error has-feedback @endif">
                    <label for="job_display_start">Display job start date</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="job_display_start" name="job_display_start" value="{{ $job->job_display_start }}">
                        @if($errors->has('job_display_start')) <label class="control-label">{{ $errors->first('job_display_start') }}</label> @endif
                    </div><!-- /.input group -->
                    <small>The date this job should start being displayed on the site. To start displaying immediately, leave blank.</small>
                </div><!-- /.form group -->
            </div>

            <div class="col-md-3">
                <div class="form-group @if($errors->has('job_display_end')) has-error has-feedback @endif">
                    <label for="job_display_end">Display job end date</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="job_display_end" name="job_display_end" value="{{ $job->job_display_end }}">
                        @if($errors->has('job_display_end')) <label class="control-label">{{ $errors->first('job_display_end') }}</label> @endif
                    </div><!-- /.input group -->
                    <small>The date this job should stop being displayed on the site. To display indefinitely, leave blank.</small>
                </div><!-- /.form group -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group @if($errors->has('job_information')) has-error has-feedback @endif">
                    <label for="job_information">Job information in details</label>
                    <textarea name="job_information" id="job_information" cols="30" rows="10" class="form-control">{{ $job->job_information }}</textarea>
                    @if($errors->has('job_information')) <label class="control-label">{{ $errors->first('job_information') }}</label> @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if($errors->has('location')) has-error has-feedback @endif">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control" required value="{{ $job->location }}">
                            @if($errors->has('location')) <label class="control-label">{{ $errors->first('location') }}</label> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if($errors->has('p11')) has-error has-feedback @endif">
                            <label for="p11">P11 upload</label>
                            <input type="file" class="" name="p11" id="p11"> Uploaded: @if($job->p11 != '') <a href="/{{ $job->p11 }}" target="_blank">Download</a> @else NO FILE @endif
                            @if($errors->has('p11')) <label class="control-label">{{ $errors->first('p11') }}</label> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if($errors->has('additional_file')) has-error has-feedback @endif">
                            <label for="p11">Additional file</label>
                            <input type="file" class="" name="additional_file" id="additional_file"> Uploaded: @if($job->additional_file != '') <a href="/{{ $job->additional_file }}" target="_blank">Download</a> @else NO FILE @endif
                            @if($errors->has('additional_file')) <label class="control-label">{{ $errors->first('additional_file') }}</label> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="email_list">Email list</label>
                        <div class="input-group @if($errors->has('email_list')) has-error has-feedback @endif">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" placeholder="Email list for notifications, separate with comma" name="email_list" id="email_list" value="{{ $job->email_list }}">
                            @if($errors->has('email_list')) <label class="control-label">{{ $errors->first('email_list') }}</label> @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label for="highlighted">
                                <input type="checkbox" id="highlighted" name="highlighted" value="highlighted" @if($job->highlighted == 1) checked @endif> Highlighted (Mark this job as highlighted? And display in other color on frontpage)
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                <div id='formbuilder'></div>
            </div>

            <div class="col-md-2">
                <label for="custom_form">JSON representation preview</label>
                <textarea name="custom_form" id="custom_form" cols="30" rows="10" class="form-control">{{ $job->custom_form }}</textarea>
            </div>
        </div>


        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-primary margin pull-right">Save job to database</button>

    </form>

    <div class="clearfix"></div>

</section>

<?php
$data = $job->custom_form;
$data = ltrim($data, '{"fields":');
$data = rtrim($data, '}');
?>

@stop

@section('scripts')

    <script>
        $('#job_start').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#job_end').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#job_display_start').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('#job_display_end').datepicker({
            format: 'yyyy-mm-dd'
        });
        CKEDITOR.replace('job_information');
    </script>
@stop



@section('form-scripts')
    <script>

        $(function(){
            fb = new Formbuilder({
                selector: '#formbuilder',
                bootstrapData: {{ $data }}
            });

            fb.on('save', function(payload){
                $('#custom_form').val(payload);
            });
        });
    </script>
@stop


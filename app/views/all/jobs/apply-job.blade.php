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

                <?php
                    $json_form = json_decode($job->custom_form);
                    $array_of_fields = array();
                    $array_of_types = array();
                ?>

                <form action="{{ URL::route('send-application', $job->id) }}" method="post" enctype="multipart/form-data">

                    @foreach($json_form->fields as $field)
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    $name = rtrim($field->label, ': *');
                                    $name = rtrim($field->label, ':*');
                                    $name = rtrim($field->label, '*');
                                    $name = rtrim($field->label);
                                    $name = rtrim($field->label, ':');

                                    $lettersNumbersSpacesHypens = '/[^\-\s\pN\pL]+/u';
                                    $spacesDuplicateHypens = '/[\-\s]+/';
                                    $name = preg_replace($lettersNumbersSpacesHypens, '', mb_strtolower($name, 'UTF-8'));
                                    $name = preg_replace($spacesDuplicateHypens, '_', $name);
                                    $name = trim($name, '_');

                                    array_push($array_of_fields, $name);
                                    array_push($array_of_types, $field->field_type);

                                ?>

                                @if($field->field_type == 'text')
                                    <div class="row">
                                        <label>{{ $field->label }}</label>
                                        <input type="text" class="form-control" name="{{ $name }}" @if($field->required == true) required @endif style="margin: 5px 0">
                                    </div>
                                @elseif($field->field_type == 'paragraph')
                                    <div class="row">
                                        <label>{{ $field->label }}</label>
                                        <textarea name="{{ $name }}" cols="30" rows="10" @if($field->required == true) required @endif style="margin: 5px 0"></textarea><br>
                                    </div>
                                @elseif($field->field_type == 'checkboxes')
                                    <div class="row">
                                        <label>{{ $field->label }}</label>
                                        @foreach($field->field_options->options as $option)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="{{ $name }}[]" value="{{ $option->label }}"> {{ $option->label }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                @elseif($field->field_type == 'radio')
                                    <div class="row">
                                        <label>{{ $field->label }}</label>
                                        @foreach($field->field_options->options as $option)
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="{{ $name }}" value="{{ $option->label }}">
                                                {{ $option->label }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                @elseif($field->field_type == 'dropdown')
                                    <div class="row">
                                        <label>{{ $field->label }}</label>
                                        <select name="{{ $name }}" @if($field->required == true) required @endif class="form-control" style="margin: 5px 0">
                                            @foreach($field->field_options->options as $option)
                                                <option value="{{ $option->label }}">{{ $option->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @elseif($field->field_type == 'email')
                                    <div class="row">
                                        <label>{{ $field->label }}</label>
                                        <input type="email" class="form-control" name="{{ $name }}" @if($field->required == true) required @endif style="margin: 5px 0">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-12">
                            @if($job->job_type == 'roster')
                                @if($job->p11 != '')
                                <div class="row">
                                    <div class="form-group @if($errors->has('p11')) has-error has-feedback @endif">
                                        <label>P11 Upload</label>
                                        <input type="file" class="" name="p11" id="p11">
                                        @if($errors->has('p11')) <label class="control-label">{{ $errors->first('p11') }}</label> @endif
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <div class="form-group @if($errors->has('additional_file')) has-error has-feedback @endif">
                                        <label>Additional File Upload</label>
                                        <input type="file" class="" name="additional_file" id="additional_file">
                                        @if($errors->has('additional_file')) <label class="control-label">{{ $errors->first('additional_file') }}</label> @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <?php
                        $array_types = implode(', ', $array_of_types);
                        $array_fields =  implode(', ', $array_of_fields);
                    ?>

                    <input type="hidden" name="array_types" value="{{ $array_types }}">
                    <input type="hidden" name="array_values" value="{{ $array_fields }}">

                    <div class="row">
                        <hr>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-primary pull-right">Apply for job</button>
                    </div>

                </form>

            @endif

        </div>

        @include('all.includes.widgets')

    </div>

@stop
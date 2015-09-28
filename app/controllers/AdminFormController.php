<?php
class AdminFormController extends BaseController {

    public function getJobCreator() {
        $job_types = JobType::all();
        return View::make('admin.forms.create')
            ->with('job_types', $job_types);
    }

    public function postJobCreator() {
        $validator = Validator::make(Input::all(), [
            'job_type' => 'required',
            'job_name' => 'required',
            'job_start' => '',
            'job_end' => '',
            'job_display_start' => '',
            'job_display_end' => '',
            'job_information' => 'required',
            'location' => 'required',
            'p11' => 'max:67108864|mimes:pdf,doc,docx',
            'additional_file' => 'max:67108864|mimes:pdf,doc,docx,zip,rar,7zip',
            'email_list' => '',
            'highlighted' => 'required',
            'custom_form' => ''
        ]);

        if($validator->fails()) {
            return Redirect::route('admin-job-creator')
                ->withErrors($validator)
                ->withInput();
        } else {

            $job_type = Input::get('job_type');
            $job_name = Input::get('job_name');
            $job_start = Input::get('job_start');
            $job_end = Input::get('job_end');
            $job_display_start = Input::get('job_display_start');
            $job_display_end = Input::get('job_display_end');
            $job_information = Input::get('job_information');
            $location = Input::get('location');
            $email_list = Input::get('email_list');
            $custom_form = Input::get('custom_form');
            if(Input::get('highlighted') === 'highlighted') {
                $highlighted = 1;
            } else {
                $highlighted = 0;
            }


            //Create slug
            $lettersNumbersSpacesHypens = '/[^\-\s\pN\pL]+/u';
            $spacesDuplicateHypens = '/[\-\s]+/';
            $job_slug = preg_replace($lettersNumbersSpacesHypens, '', mb_strtolower($job_name, 'UTF-8'));
            $job_slug = preg_replace($spacesDuplicateHypens, '-', $job_slug);
            $job_slug = trim($job_slug, '-');

            $destinationPath = 'public/jobs/' . $job_type . '/';

            if (!file_exists($destinationPath . $job_slug)) {
                mkdir($destinationPath . $job_slug, 0777, true);
            }

            $p11_name = $_FILES['p11']['name'];

            $p11_full = '';
            $additional_file_full = '';

            if($p11_name != '' && $_FILES['p11']['error'] == 0 ) {
                move_uploaded_file($_FILES['p11']['tmp_name'], "{$destinationPath}{$job_slug}/{$p11_name}");
                $p11_full = $destinationPath . $job_slug . '/' . $p11_name;
            }

            $additional_file_name = $_FILES['additional_file']['name'];

            if($additional_file_name != '' && $_FILES['additional_file']['error'] == 0 ) {
                move_uploaded_file($_FILES['additional_file']['tmp_name'], "{$destinationPath}{$job_slug}/{$additional_file_name}");
                $additional_file_full = $destinationPath . $job_slug . '/' . $additional_file_name;
            }

            $p11_full = ltrim($p11_full, 'public/');
            $additional_file_full = ltrim($additional_file_full, 'public/');

            $job = Job::create([
                'job_type' => $job_type,
                'job_name' => $job_name,
                'job_start' => $job_start,
                'job_end' => $job_end,
                'job_display_start' => $job_display_start,
                'job_display_end' => $job_display_end,
                'job_information' => $job_information,
                'location' => $location,
                'p11' => $p11_full,
                'additional_file' => $additional_file_full,
                'email_list' => $email_list,
                'highlighted' => $highlighted,
                'custom_form' => $custom_form,
            ]);

            if($job) {
                return Redirect::route('admin-home')
                    ->with('success', 'New job has been created.');
            } else {
                return Redirect::route('admin-home')
                    ->with('error', 'There was an error creating job. Please try again later');
            }

        }
    }

    public function getViewJobs() {
        $jobs = Job::all();
        return View::make('admin.forms.view-jobs')
            ->with('jobs', $jobs);
    }

    public function getViewJob($id) {
        $job = Job::find($id);
        $job_types = JobType::all();
        return View::make('admin.forms.view-job')
            ->with('job', $job)
            ->with('job_types', $job_types);
    }

    public function postViewJob($id) {
        $validator = Validator::make(Input::all(), [
            'job_type' => 'required',
            'job_name' => 'required',
            'job_start' => '',
            'job_end' => '',
            'job_display_start' => '',
            'job_display_end' => '',
            'job_information' => 'required',
            'location' => 'required',
            'p11' => 'max:67108864|mimes:pdf,doc,docx',
            'additional_file' => 'max:67108864|mimes:pdf,doc,docx,zip,rar,7zip',
            'email_list' => '',
            'highlighted' => 'required',
            'custom_form' => ''
        ]);

        if($validator->fails()) {
            return Redirect::route('admin-view-job', $id)
                ->withErrors($validator)
                ->withInput();
        } else {

            $job_type = Input::get('job_type');
            $job_name = Input::get('job_name');
            $job_start = Input::get('job_start');
            $job_end = Input::get('job_end');
            $job_display_start = Input::get('job_display_start');
            $job_display_end = Input::get('job_display_end');
            $job_information = Input::get('job_information');
            $location = Input::get('location');
            $email_list = Input::get('email_list');
            $custom_form = Input::get('custom_form');
            if(Input::get('highlighted') === 'highlighted') {
                $highlighted = 1;
            } else {
                $highlighted = 0;
            }


            //Create slug
            $lettersNumbersSpacesHypens = '/[^\-\s\pN\pL]+/u';
            $spacesDuplicateHypens = '/[\-\s]+/';
            $job_slug = preg_replace($lettersNumbersSpacesHypens, '', mb_strtolower($job_name, 'UTF-8'));
            $job_slug = preg_replace($spacesDuplicateHypens, '-', $job_slug);
            $job_slug = trim($job_slug, '-');

            $destinationPath = 'public/jobs/' . $job_type . '/';

            if (!file_exists($destinationPath . $job_slug)) {
                mkdir($destinationPath . $job_slug, 0777, true);
            }

            $p11_name = $_FILES['p11']['name'];

            $p11_full = '';
            $additional_file_full = '';

            if($p11_name != '' && $_FILES['p11']['error'] == 0 ) {
                move_uploaded_file($_FILES['p11']['tmp_name'], "{$destinationPath}{$job_slug}/{$p11_name}");
                $p11_full = $destinationPath . $job_slug . '/' . $p11_name;
            }

            $additional_file_name = $_FILES['additional_file']['name'];

            if($additional_file_name != '' && $_FILES['additional_file']['error'] == 0 ) {
                move_uploaded_file($_FILES['additional_file']['tmp_name'], "{$destinationPath}{$job_slug}/{$additional_file_name}");
                $additional_file_full = $destinationPath . $job_slug . '/' . $additional_file_name;
            }

            $p11_full = ltrim($p11_full, 'public/');
            $additional_file_full = ltrim($additional_file_full, 'public/');

            $job = Job::find($id);

            $job->job_type = $job_type;
            $job->job_name = $job_name;
            $job->job_start = $job_start;
            $job->job_end = $job_end;
            $job->job_display_start = $job_display_start;
            $job->job_display_end = $job_display_end;
            $job->job_information = $job_information;
            $job->location = $location;
            $job->p11 = $p11_full;
            $job->additional_file = $additional_file_full;
            $job->email_list = $email_list;
            $job->highlighted = $highlighted;
            $job->custom_form = $custom_form;

            if($job->save()) {
                return Redirect::route('admin-view-job', $id)
                    ->with('success', 'Job has been edited.');
            } else {
                return Redirect::route('admin-view-job', $id)
                    ->with('error', 'There was an error editing job. Please try again later');
            }

        }
    }

    public function getSetupFilters() {
        $jobs = Job::all();
        return View::make('admin.filters.setup-filters')
            ->with('jobs', $jobs);
    }

    public function postSetupFilters() {
        $jobs = Job::all();
        Filter::truncate();
        $filters = [];

        foreach($jobs as $job) {
            $name = 'filters_' . $job->id;

            if(!empty($_POST[$name])) {
                foreach($_POST[$name] as $check) {
                    array_push($filters, $check);
                }
            }

            if(!empty($filters)){
                $list_of_filters = implode(', ', $filters);

                Filter::create([
                    'job_id' => $job->id,
                    'filters' => $list_of_filters
                ]);

                $filters = [];
            }
        }

        return Redirect::route('admin-setup-filters')
            ->with('success', 'Filter added');

    }

}
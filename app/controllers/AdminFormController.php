<?php
class AdminFormController extends BaseController {

    public function getJobCreator() {
        $job_types = JobType::all();
        return View::make('admin.forms.create')
            ->with('job_types', $job_types);
    }

    public function postJobCreator() {
        $validator = new Validator(Input::all(), [
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

        if(1 == 0) {
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

            $job = Job::create([
                'job_type' => $job_type,
                'job_name' => $job_name,
                'job_start' => $job_start,
                'job_end' => $job_end,
                'job_display_start' => $job_display_start,
                'job_display_end' => $job_display_end,
                'job_information' => $job_information,
                'location' => $location,
                'p11' => ltrim($p11_full, 'public/'),
                'additional_file' => ltrim($additional_file_full, 'public/'),
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

}
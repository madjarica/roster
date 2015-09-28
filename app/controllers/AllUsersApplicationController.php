<?php
class AllUsersApplicationController extends BaseController {

    public function postApplication($job_id) {

        $job = Job::find($job_id);
        $job_type = $job->job_type;

        $array_types = Input::get('array_types');
        $array_fields = Input::get('array_values');

        $array_of_types = explode(', ', $array_types);
        $array_of_fields = explode(', ', $array_fields);

        $form = [];

        $application_email = '';

        foreach($array_of_types as $k => $type) {
            $field = '';

            $helper = $array_of_fields[$k];

            if($type == 'text') {
                $label = ucwords(str_replace( '_', ' ', $helper));
                $value = Input::get($helper);
                $field .= "{\"label\":\"$label\",\"value\":\"$value\"}";
                array_push($form, $field);
            } elseif($type == 'email') {
                $label = ucwords(str_replace( '_', ' ', $helper));
                $value = Input::get($helper);
                $field .= "{\"label\":\"$label\",\"value\":\"$value\"}";
                $application_email = $value;
                array_push($form, $field);
            } elseif($type == 'paragraph') {
                $label = ucwords(str_replace( '_', ' ', $helper));
                $value = Input::get($helper);
                $field .= "{\"label\":\"$label\",\"value\":\"$value\"}";
                array_push($form, $field);
            } elseif($type == 'radio') {
                $label = ucwords(str_replace( '_', ' ', $helper));
                $value = Input::get($helper);
                $field .= "{\"label\":\"$label\",\"value\":\"$value\"}";
                array_push($form, $field);
            } elseif($type == 'dropdown') {
                $label = ucwords(str_replace( '_', ' ', $helper));
                $value = Input::get($helper);
                $field .= "{\"label\":\"$label\",\"value\":\"$value\"}";
                array_push($form, $field);
            } elseif($type == 'checkboxes') {
                $label = ucwords(str_replace( '_', ' ', $helper));
                $value = '';

                if(!empty($_POST[$helper])) {
                    foreach($_POST[$helper] as $check) {
                        $value .= $check . ', ';
                    }
                }

                $value = rtrim($value, ', ');

                $field .= "{\"label\":\"$label\",\"value\":\"$value\"}";
                array_push($form, $field);
            }
        }

        $forma = json_encode($form);

        //Create slug
        $lettersNumbersSpacesHypens = '/[^\-\s\pN\pL]+/u';
        $spacesDuplicateHypens = '/[\-\s]+/';
        $job_slug = preg_replace($lettersNumbersSpacesHypens, '', mb_strtolower($job->job_name, 'UTF-8'));
        $job_slug = preg_replace($spacesDuplicateHypens, '-', $job_slug);
        $job_slug = trim($job_slug, '-');

        $destinationPath = 'public/applications/' . $job_type . '/';

        $date = new DateTime();
        $result = $date->format('Y-m-d_H-i-s');

        if (!file_exists($destinationPath . $job_slug . '/' . $result)) {
            mkdir($destinationPath . $job_slug . '/' . $result, 0777, true);
        }

        $p11_full = '';
        $additional_file_full = '';

        $p11_name = $_FILES['p11']['name'];

        if($p11_name != '' && $_FILES['p11']['error'] == 0 ) {
            move_uploaded_file($_FILES['p11']['tmp_name'], "{$destinationPath}{$job_slug}/{$result}/{$p11_name}");
            $p11_full = $destinationPath . $job_slug . '/' . $result . '/' . $p11_name;
        }

        $additional_file_name = $_FILES['additional_file']['name'];

        if($additional_file_name != '' && $_FILES['additional_file']['error'] == 0 ) {
            move_uploaded_file($_FILES['additional_file']['tmp_name'], "{$destinationPath}{$job_slug}/{$result}/{$additional_file_name}");
            $additional_file_full = $destinationPath . $job_slug . '/' . $result . '/' . $additional_file_name;
        }

        $p11_full = ltrim($p11_full, 'public/');
        $additional_file_full = ltrim($additional_file_full, 'public/');

        $application = Application::create([
            'job_id' => $job_id,
            'data' => $forma,
            'p11' => $p11_full,
            'additional_file' => $additional_file_full
        ]);

        $data = $application->data;

        if($application) {
            if($application_email != '') {
                Mail::queue('emails.all.new-application', array(
                    'data' => $data
                ), function($m) use ($application_email) {
                    $m->to($application_email, $application_email)->subject('Application sent');
                });
            }

            $email_list = $job->email_list;
            $email_list_array = explode(',', $email_list);

            $p11 = $application->p11;
            $additional_file = $application->additional_file;

            foreach($email_list_array as $email) {
                Mail::queue('emails.admin.new-application', array(
                    'data' => $data,
                    'p11' => $p11,
                    'additional_file' => $additional_file
                ), function($m) use ($email) {
                    $m->to(trim($email), trim($email))->subject('New application');
                });
            }

            return Redirect::route('home')
                ->with('success', 'Your application has been sent. Thank you.');
        } else {
            return Redirect::route('apply-job', $job_id)
                ->with('error', 'There was an sending your application. Please try again later');
        }
    }
}
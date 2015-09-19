<?php


class Job extends Eloquent  {

    protected $table = 'jobs';

    protected $fillable = array(
        'id',
        'job_type',
        'job_name',
        'job_start',
        'job_end',
        'job_display_start',
        'job_display_end',
        'job_information',
        'location',
        'p11',
        'additional_file',
        'email_list',
        'highlighted',
        'custom_form',
        'created_at',
        'updated_at');

}

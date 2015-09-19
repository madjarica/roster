<?php


class JobType extends Eloquent  {

    protected $table = 'job_types';

    protected $fillable = array('id', 'job_type', 'job_type_slug', 'created_at', 'updated_at');

}

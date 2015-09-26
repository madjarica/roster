<?php

class Application extends Eloquent {

    protected $table = 'applications';

    protected $hidden = array('id', 'created_at', 'updated_at');

    protected $fillable = array('job_id', 'data', 'p11', 'additional_file', 'created_at', 'updated_at');

}

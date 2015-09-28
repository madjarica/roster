<?php

class Filter extends Eloquent  {

    protected $table = 'filters';

    protected $fillable = array('id', 'job_id', 'filters', 'created_at', 'updated_at');

}

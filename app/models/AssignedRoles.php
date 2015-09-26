<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AssignedRoles extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = 'assigned_roles';

    protected $hidden = array('id', 'created_at', 'updated_at');

    protected $fillable = array('user_id', 'role_id', 'created_at', 'updated_at');

}

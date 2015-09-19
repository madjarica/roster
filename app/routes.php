<?php
/*
|--------------------------------------------------------------------------
| ALL USERS
|--------------------------------------------------------------------------|
*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'AllUsersPagesController@getHome'
]);

/*
|--------------------------------------------------------------------------
| ADMIN USERS
|--------------------------------------------------------------------------|
*/
Route::get('/admin', [
  'as' => 'admin-home',
  'uses' => 'AdminPagesController@getAdminHome'
]);

Route::get('/admin/job-creator', [
    'as' => 'admin-job-creator',
    'uses' => 'AdminFormController@getJobCreator'
]);

Route::post('/admin/job-creator-post', [
    'as' => 'admin-job-creator-post',
    'uses' => 'AdminFormController@postJobCreator'
]);


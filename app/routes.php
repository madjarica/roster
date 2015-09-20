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

Route::get('/view-job/{id}', [
    'as' => 'view-job',
    'uses' => 'AllUsersPagesController@getViewJob'
]);

Route::get('/view-jobs/{category}', [
    'as' => 'view-jobs',
    'uses' => 'AllUsersPagesController@getViewJobs'
]);

Route::get('/apply-job/{id}', [
    'as' => 'apply-job',
    'uses' => 'AllUsersPagesController@getApplyJob'
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


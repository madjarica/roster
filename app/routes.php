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

Route::group(array('before' => 'csrf'), function() {

    Route::post('/login-post', [
        'as' => 'login-post',
        'uses' => 'AdminAccountController@postLogin'
    ]);

    Route::post('/send-application/{job_id}', [
        'as' => 'send-application',
        'uses' => 'AllUsersApplicationController@postApplication'
    ]);

});

/*
|--------------------------------------------------------------------------
| UNAUTHENTICATED USERS
|--------------------------------------------------------------------------|
*/

Route::group(array('before' => 'guest'), function() {

    Route::get('/login', [
        'as' => 'login',
        'uses' => 'AdminPagesController@getLogin'
    ]);

    Route::get('/forgot-password', [
        'as' => 'forgot-password',
        'uses' => 'AdminAccountController@getForgotPassword'
    ]);

    Route::get('/account/recover/{code}', array(
        'as' => 'account-recover',
        'uses' => 'AdminAccountController@getRecover'
    ));

    Route::group(array('before' => 'csrf'), function() {

        Route::post('forgot-password-post', [
            'as' => 'forgot-password-post',
            'uses' => 'AdminAccountController@postForgotPassword'
        ]);

    });

});

/*
|--------------------------------------------------------------------------
| ADMIN USERS
|--------------------------------------------------------------------------|
*/

Route::group(array('before' => 'auth'), function() {

    Route::get('/admin', [
        'as' => 'admin-home',
        'uses' => 'AdminPagesController@getAdminHome'
    ]);

    Route::get('/admin/change-password', [
        'as' => 'admin-change-password',
        'uses' => 'AdminAccountController@getChangePassword'
    ]);

    Route::get('/admin/change-profile-image', [
        'as' => 'admin-change-profile-image',
        'uses' => 'AdminAccountController@getChangeProfileImage'
    ]);

    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'AdminAccountController@getLogOut'
    ]);

    Route::get('/admin/job-creator', [
        'as' => 'admin-job-creator',
        'uses' => 'AdminFormController@getJobCreator'
    ]);

    Route::get('/admin/view-jobs', [
        'as' => 'admin-view-jobs',
        'uses' => 'AdminFormController@getViewJobs'
    ]);

    Route::get('/admin/view-job/{id}', [
        'as' => 'admin-view-job',
        'uses' => 'AdminFormController@getViewJob'
    ]);

    Route::get('/admin/add-user', [
        'as' => 'admin-add-user',
        'uses' => 'AdminAccountController@getAddUser'
    ]);

    Route::get('/admin/view-users', [
        'as' => 'admin-view-users',
        'uses' => 'AdminAccountController@getViewUsers'
    ]);

    Route::get('/admin/view-user/{id}', [
        'as' => 'admin-view-user',
        'uses' => 'AdminAccountController@getViewUser'
    ]);

    Route::get('/admin/setup-filters/', [
        'as' => 'admin-setup-filters',
        'uses' => 'AdminFormController@getSetupFilters'
    ]);

    Route::group(array('before' => 'csrf'), function() {

        Route::post('/admin/job-creator-post', [
            'as' => 'admin-job-creator-post',
            'uses' => 'AdminFormController@postJobCreator'
        ]);

        Route::post('/admin/view-job-post/{id}', [
            'as' => 'admin-view-job-post',
            'uses' => 'AdminFormController@postViewJob'
        ]);

        Route::post('/admin/add-user-post', [
            'as' => 'admin-add-user-post',
            'uses' => 'AdminAccountController@postAddUser'
        ]);

        Route::post('/admin/view-user-post/{id}', [
            'as' => 'admin-view-user-post',
            'uses' => 'AdminAccountController@postViewUser'
        ]);

        Route::post('/admin/change-password-post', [
            'as' => 'admin-change-password-post',
            'uses' => 'AdminAccountController@postChangePassword'
        ]);

        Route::post('/admin/change-profile-image', [
            'as' => 'admin-upload-avatar-post',
            'uses' => 'AdminAccountController@postChangeProfileImage'
        ]);

        Route::post('/admin/setup-filters-post/', [
            'as' => 'admin-setup-filters-post',
            'uses' => 'AdminFormController@postSetupFilters'
        ]);
    });

    /*
    |--------------------------------------------------------------------------
    | AJAX
    |--------------------------------------------------------------------------|
    */

    Route::get('/admin/delete-user/{id?}', array(
        'as' => 'delete-user',
        'uses' => 'AjaxController@deleteUser'
    ));


    Route::get('/admin/delete-job/{id?}', array(
        'as' => 'delete-job',
        'uses' => 'AjaxController@deleteJob'
    ));

    Route::get('/admin/approve-application/{id}/{status}', array(
        'as' => 'approve-application',
        'uses' => 'AjaxController@getApproveApplication'
    ));

});

Route::group(array('before' => 'csrf'), function() {

});

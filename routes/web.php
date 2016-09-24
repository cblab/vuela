<?php
Route::get('/', function() {
    return view('index');
});

Route::get('/latest-tasks', function () {
    return App\Models\Task::latest()->get();
});

Route::group(['middleware' => ['web']], function() {
    Route::resource('items','Admin\ItemController');
    Route::resource('tasks','Admin\TaskController');

    // Login Routes...
    Route::get('admin', [
        'middleware' => 'auth',
        'uses'       => 'Admin\AdminController@index',
        'as'         => 'admin.index'
    ]);

    Route::get('manage-items', [
        'middleware' => 'auth',
        'uses'       => 'Admin\ItemController@manageItems',
        'as'         => 'manage-items'
    ]);

    Route::get('manage-tasks', [
        'middleware' => 'auth',
        'uses'       => 'Admin\TaskController@manageTasks',
        'as'         => 'manage-tasks'
    ]);

    Route::get('login',   ['as' => 'login',       'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login',  ['as' => 'login.post',  'uses' => 'Auth\LoginController@login']);
    Route::get('logout',  ['as' => 'logout',      'uses' => 'Auth\LoginController@logout']);
    Route::post('logout', ['as' => 'logout',      'uses' => 'Auth\LoginController@logout']);

    // Registration Routes...
    Route::get('register',  ['as' => 'register',       'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post',  'uses' => 'Auth\RegisterController@register']);

    // Password Reset Routes...
    Route::get('password/reset',  ['as' => 'password.reset',     'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email',     'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post',         'uses' => 'Auth\ResetPasswordController@reset']);
});

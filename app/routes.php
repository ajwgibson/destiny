<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

Route::group(array('prefix' => 'order'), function()
{
    Route::get ('contact_details/{transaction_id?}', array('as' => 'order.contact_details',    'uses' => 'OrderController@contactDetails'));
    Route::post('contact_details/{transaction_id?}', array('as' => 'order.contact_details.do', 'uses' => 'OrderController@doContactDetails'));

    Route::get ('permissions/{transaction_id}', array('as' => 'order.permissions',    'uses' => 'OrderController@permissions'));
    Route::post('permissions/{transaction_id}', array('as' => 'order.permissions.do', 'uses' => 'OrderController@doPermissions'));
    
    Route::get ('confirmation/{transaction_id}', array('as' => 'order.confirmation',    'uses' => 'OrderController@confirmation'));
});

/* 
* Login
*/
Route::get ('/login',  array('as' => 'login',    'uses' => 'LoginController@showLogin'));
Route::post('/login',  array('as' => 'do.login', 'uses' => 'LoginController@doLogin'));
Route::get ('/logout', array('as' => 'logout',   'uses' => 'LoginController@logout'));


/* 
* Admin routes
*/
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'auth.admin'), function()
{
    Route::get('/',    array('as' => 'admin.home',       'uses' => 'HomeController@index'));
    Route::get('user', array('as' => 'admin.user.index', 'uses' => 'UserController@index'));

    Route::get('user/{user}/editPassword',    array('as' => 'admin.user.editPassword',   'uses' => 'UserController@editPassword'));
    Route::post('user/{user}/updatePassword', array('as' => 'admin.user.updatePassword', 'uses' => 'UserController@updatePassword'));
});


/* 
* Registration routes
*/
Route::group(array('prefix' => 'registration', 'namespace' => 'Registration', 'before' => 'auth.registration'), function()
{
    Route::get('/', array('as' => 'registration.home', 'uses' => 'HomeController@index'));
});

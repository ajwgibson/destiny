<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

Route::group(array('prefix' => 'order'), function()
{
    Route::group(array('before' => 'order_verified'), function()
    {
        Route::group(array('before' => 'order_in_session'), function()
        {
            Route::get ('contact_details/{transaction_id?}', array('as' => 'order.contact_details',    'uses' => 'OrderController@contactDetails'));
            Route::post('contact_details/{transaction_id?}', array('as' => 'order.contact_details.do', 'uses' => 'OrderController@doContactDetails'));

            Route::get ('permissions/{transaction_id}', array('as' => 'order.permissions',    'uses' => 'OrderController@permissions'));
            Route::post('permissions/{transaction_id}', array('as' => 'order.permissions.do', 'uses' => 'OrderController@doPermissions'));
            
            Route::get ('children/{transaction_id}',          array('as' => 'order.children',     'uses' => 'OrderController@children'));  
            Route::get ('child/{transaction_id}/{child_id?}', array('as' => 'order.child',        'uses' => 'OrderController@child'));  
            Route::post('child/{transaction_id}/{child_id?}', array('as' => 'order.child.do',        'uses' => 'OrderController@doChild'));  

            Route::get ('remove_child/{transaction_id}/{child_id}', array('as' => 'order.remove.child',    'uses' => 'OrderController@removeChild'));  
            Route::post('remove_child/{transaction_id}/{child_id}', array('as' => 'order.remove.child.do', 'uses' => 'OrderController@doRemoveChild'));  

            Route::get ('voucher/{transaction_id}', array('as' => 'order.voucher',    'uses' => 'OrderController@voucher'));
            Route::post('voucher/{transaction_id}', array('as' => 'order.voucher.do', 'uses' => 'OrderController@doVoucher'));

            Route::post('apply_voucher/{transaction_id}', array('as' => 'order.voucher.apply.do', 'uses' => 'OrderController@doApplyVoucher'));

            Route::get ('extra/{transaction_id}', array('as' => 'order.extra',    'uses' => 'OrderController@extra'));
            Route::post('extra/{transaction_id}', array('as' => 'order.extra.do', 'uses' => 'OrderController@doExtra'));

            Route::get ('summary/{transaction_id}', array('as' => 'order.summary',    'uses' => 'OrderController@summary'));  
            Route::post('summary/{transaction_id}', array('as' => 'order.summary.do',    'uses' => 'OrderController@doSummary'));  

            Route::get ('confirmation/{transaction_id}', array('as' => 'order.confirmation',    'uses' => 'OrderController@confirmation'));  
        });

        Route::get ('authentication/{transaction_id}', array('as' => 'order.authentication',    'uses' => 'OrderController@authentication'));
        Route::post('authentication/{transaction_id}', array('as' => 'order.authentication.do', 'uses' => 'OrderController@doAuthentication'));  
    });

    Route::get ('new', array('as' => 'order.new', 'uses' => 'OrderController@newOrder'));

    Route::get ('verification/{transaction_id}', array('as' => 'order.verification',    'uses' => 'OrderController@verification'));
    Route::post('verification/{transaction_id}', array('as' => 'order.verification.do', 'uses' => 'OrderController@doVerification'));
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

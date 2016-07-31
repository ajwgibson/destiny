<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/',     array('as' => 'home', 'uses' => 'HomeController@index'));
Route::get('/faqs', array('as' => 'faqs', 'uses' => 'HomeController@faqs'));

/*
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
*/

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
    
    Route::get('faq/up/{id}',   array('as' => 'admin.faq.up',   'uses' => 'FAQController@up'));
    Route::get('faq/down/{id}', array('as' => 'admin.faq.down', 'uses' => 'FAQController@down'));
    Route::resource('faq', 'FAQController');

    Route::get('user/{user}/editPassword',    array('as' => 'admin.user.editPassword',   'uses' => 'UserController@editPassword'));
    Route::post('user/{user}/updatePassword', array('as' => 'admin.user.updatePassword', 'uses' => 'UserController@updatePassword'));

    Route::get ('order/contact_details/{transaction_id?}', array('as' => 'admin.order.contact_details',    'uses' => 'OrderController@contactDetails'));
    Route::post('order/contact_details/{transaction_id?}', array('as' => 'admin.order.contact_details.do', 'uses' => 'OrderController@doContactDetails'));

    Route::get ('order/children/{transaction_id}',          array('as' => 'admin.order.children', 'uses' => 'OrderController@children'));  
    Route::get ('order/child/{transaction_id}/{child_id?}', array('as' => 'admin.order.child',    'uses' => 'OrderController@child'));  
    Route::post('order/child/{transaction_id}/{child_id?}', array('as' => 'admin.order.child.do', 'uses' => 'OrderController@doChild'));  

    Route::get ('order/remove_child/{transaction_id}/{child_id}', array('as' => 'admin.order.remove.child',    'uses' => 'OrderController@removeChild'));  
    Route::post('order/remove_child/{transaction_id}/{child_id}', array('as' => 'admin.order.remove.child.do', 'uses' => 'OrderController@doRemoveChild'));  
            
    Route::get ('order/permissions/{transaction_id}', array('as' => 'admin.order.permissions',    'uses' => 'OrderController@permissions'));
    Route::post('order/permissions/{transaction_id}', array('as' => 'admin.order.permissions.do', 'uses' => 'OrderController@doPermissions'));
            
    Route::get ('order/voucher/{transaction_id}', array('as' => 'admin.order.voucher',    'uses' => 'OrderController@voucher'));
    Route::post('order/voucher/{transaction_id}', array('as' => 'admin.order.voucher.do', 'uses' => 'OrderController@doVoucher'));

    Route::post('order/apply_voucher/{transaction_id}', array('as' => 'admin.order.voucher.apply.do', 'uses' => 'OrderController@doApplyVoucher'));

    Route::get ('order/summary/{transaction_id}', array('as' => 'admin.order.summary',    'uses' => 'OrderController@summary'));  
    Route::post('order/summary/{transaction_id}', array('as' => 'admin.order.summary.do', 'uses' => 'OrderController@doSummary'));  

    Route::get ('order/confirmation/{transaction_id}', array('as' => 'admin.order.confirmation',    'uses' => 'OrderController@confirmation'));  
    
    Route::post(  'order/filter',       array('as' => 'admin.order.filter',         'uses' => 'OrderController@filter'));
    Route::get(   'order/resetFilter',  array('as' => 'admin.order.filter.reset',   'uses' => 'OrderController@resetFilter'));
    Route::get(   'order',              array('as' => 'admin.order.index',          'uses' => 'OrderController@index'));
    Route::get(   'order/{id}',         array('as' => 'admin.order.show',           'uses' => 'OrderController@show'));
    Route::delete('order/{id}/destroy', array('as' => 'admin.order.destroy',        'uses' => 'OrderController@destroy'));

    Route::post(  'voucher/filter',       array('as' => 'admin.voucher.filter',         'uses' => 'VoucherController@filter'));
    Route::get(   'voucher/resetFilter',  array('as' => 'admin.voucher.filter.reset',   'uses' => 'VoucherController@resetFilter'));
    Route::get(   'voucher',              array('as' => 'admin.voucher.index',          'uses' => 'VoucherController@index'));
    Route::get(   'voucher/create',       array('as' => 'admin.voucher.create',         'uses' => 'VoucherController@create'));
    Route::post(  'voucher/store',        array('as' => 'admin.voucher.store',          'uses' => 'VoucherController@store'));
    Route::get(   'voucher/{id}/edit',    array('as' => 'admin.voucher.edit',           'uses' => 'VoucherController@edit'));
    Route::post(  'voucher/{id}/update',  array('as' => 'admin.voucher.update',         'uses' => 'VoucherController@update'));
    Route::get(   'voucher/{id}',         array('as' => 'admin.voucher.show',           'uses' => 'VoucherController@show'));
    Route::delete('voucher/{id}/destroy', array('as' => 'admin.voucher.destroy',        'uses' => 'VoucherController@destroy'));

    Route::post('child/filter',       array('as' => 'admin.child.filter',         'uses' => 'ChildController@filter'));
    Route::get( 'child/resetFilter',  array('as' => 'admin.child.filter.reset',   'uses' => 'ChildController@resetFilter'));
    Route::get( 'child',              array('as' => 'admin.child.index',          'uses' => 'ChildController@index'));
    Route::post('child/assignTeams',  array('as' => 'admin.child.assign',         'uses' => 'ChildController@assignTeams'));
    Route::get( 'child/{id}',         array('as' => 'admin.child.show',           'uses' => 'ChildController@show'));
    Route::get( 'child/{id}/edit',    array('as' => 'admin.child.edit',           'uses' => 'ChildController@edit'));
    Route::post('child/{id}/update',  array('as' => 'admin.child.update',         'uses' => 'ChildController@update'));
    Route::get( 'child/{id}/team',    array('as' => 'admin.child.team',           'uses' => 'ChildController@team'));
    Route::post('child/{id}/team',    array('as' => 'admin.child.team.do',        'uses' => 'ChildController@updateTeam'));
    
    Route::get(   'registration',              array('as' => 'admin.registration.index',       'uses' => 'RegistrationController@index'));  
    Route::post(  'registration/filter',       array('as' => 'admin.registration.filter',      'uses' => 'RegistrationController@filter'));
    Route::get(   'registration/resetfilter',  array('as' => 'admin.registration.resetfilter', 'uses' => 'RegistrationController@resetFilter'));
    Route::get(   'registration/{id}',         array('as' => 'admin.registration.show',        'uses' => 'RegistrationController@show'));
    Route::get(   'registration/{id}/edit',    array('as' => 'admin.registration.edit',        'uses' => 'RegistrationController@edit'));
    Route::put(   'registration/{id}/update',  array('as' => 'admin.registration.update',      'uses' => 'RegistrationController@update'));
    Route::delete('registration/{id}/destroy', array('as' => 'admin.registration.destroy',     'uses' => 'RegistrationController@destroy'));

    Route::get('teamPrintout/{day?}/{team?}',   array('as' => 'printout.team',   'uses' => 'PrintoutController@teamPrintout'));
    Route::post('doTeamPrintout',               array('as' => 'doTeamPrintout',  'uses' => 'PrintoutController@doTeamPrintout'));

    Route::get('activityPrintout/{team?}/{activity?}', array('as' => 'printout.activity',   'uses' => 'PrintoutController@activityPrintout'));
    Route::post('doActivityPrintout',                  array('as' => 'doActivityPrintout',  'uses' => 'PrintoutController@doActivityPrintout'));
    
    Route::get('printLeadersLabel',  array('as' => 'printLeadersLabel', 'uses' => 'PrintoutController@printLeadersLabel'));
});


/* 
* Registration routes
*/
Route::group(array('prefix' => 'registration', 'namespace' => 'Registration', 'before' => 'auth.registration'), function()
{
    Route::get( '/',         array('as' => 'registration.home',     'uses' => 'HomeController@index'));
    Route::post('/search',   array('as' => 'registration.search',   'uses' => 'HomeController@search'));
    Route::post('/register', array('as' => 'registration.register', 'uses' => 'HomeController@register'));

    Route::get('printLabel/{child_id}/{return_url}',  array('as' => 'print.label', 'uses' => 'PrintoutController@printLabel'));

});

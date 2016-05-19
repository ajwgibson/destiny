<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic('username');
});

Route::filter('auth.registration', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});

Route::filter('auth.admin', function()
{
	if (Auth::guest()) return Redirect::guest('login');

	if (!Auth::user()->admin) 
	{
    	Auth::logout();		
		return Redirect::guest('login');
	}
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/*
|--------------------------------------------------------------------------
| Order Filters
|--------------------------------------------------------------------------
|
*/
Route::filter('order_verified', function()
{
	// If the user supplied a transaction id...
	$transaction_id = Route::input('transaction_id');

	if (!($transaction_id)) {
		// If the customer was in the middle of an order the id might still be in the session
		$transaction_id = Session::get('transaction_id');
	}

	if ($transaction_id) {

		// a. Make sure it's for a valid order
		$order = Order::where('transaction_id', $transaction_id)->firstOrFail();

		// b. If the order is already complete, only allow the confirmation page to be shown
		if ($order->status == Order::StatusComplete && Request::segment(2) != 'confirmation') {
            return Redirect::route('order.confirmation', array($transaction_id));
		}

		// c. Make sure the order has been verified
        if ($order->verification_code) {
            return Redirect::route('order.verification', array($transaction_id));
        }
	} 

});

Route::filter('order_in_session', function()
{
	$transaction_id = Route::input('transaction_id');

	if ($transaction_id) {

        $stored_transaction_id = Session::get('transaction_id');
        
        if ($stored_transaction_id != $transaction_id) {
        	Session::forget('transaction_id');
            return Redirect::route('order.authentication', array($transaction_id));
        }
	} 
});


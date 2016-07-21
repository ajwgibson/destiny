<?php

View::composer(array('registration/index'), function($view)
{
    $expected = Child::get()->count();

    $wednesday = Registration::where(DB::raw('DAYOFWEEK(registrations.created_at)'), '=', 4)->count();
    $thursday  = Registration::where(DB::raw('DAYOFWEEK(registrations.created_at)'), '=', 5)->count();
    $friday    = Registration::where(DB::raw('DAYOFWEEK(registrations.created_at)'), '=', 6)->count();

    $today     = Registration::where(DB::raw('DATE(registrations.created_at)'), DB::raw('CURDATE()'))->count();

    $view->with('expected',  $expected)
         ->with('wednesday', $wednesday)
         ->with('thursday',  $thursday)
         ->with('friday',    $friday)
         ->with('today',     $today);
});

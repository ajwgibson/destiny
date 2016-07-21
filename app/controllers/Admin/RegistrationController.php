<?php

namespace Admin;

use Registration;

use DB;
use Log;
use Input;
use Redirect;
use Session;
use Validator;
use View;

class RegistrationController extends AdminBaseController {

    /**
     * Displays a list of registrations.
     */
    public function index()
    {
        $this->layout->with('title', 'Registrations');
        $this->layout->with('subtitle', '');

        $registrations = 
            Registration::orderBy('registrations.created_at', 'desc');

        $filtered = false;
        $filter_name = Session::get('registrations_filter_name',   '');
        $filter_day  = Session::get('registrations_filter_day',    '');

        if (!(empty($filter_name))) {
            $registrations = $registrations
                ->join('children', 'registrations.child_id', '=', 'children.id', 'left outer')
                ->addSelect('registrations.*')
                ->addSelect('children.first_name')
                ->addSelect('children.last_name')
                ->where(function($query) use($filter_name) {
                    $query->where('children.first_name',       'LIKE', "%$filter_name%")
                          ->orWhere('children.last_name',      'LIKE', "%$filter_name%");
                }); 
            $filtered = true;
        }

        if (!(empty($filter_day))) {
            $registrations = $registrations->where(DB::raw('DAYOFWEEK(registrations.created_at)'), '=', $filter_day);
            $filtered = true;
        }

        $registrations = $registrations->paginate(25);

        $days = array(
            '' => 'Select a day',
            2  => 'Monday',
            3  => 'Tuesday',
            4  => 'Wednesday',
            5  => 'Thursday',
            6  => 'Friday'
        );

        $this->layout->content = 
            View::make('admin/registrations/index')
                ->with('registrations', $registrations)
                ->with('filtered',      $filtered)
                ->with('filter_name',   $filter_name)
                ->with('days',          $days)
                ->with('filter_day',    $filter_day);
    }

    /**
     * Changes the list filter values in the session
     * and redirects back to the index to force the filtered
     * list to be displayed.
     */
    public function filter()
    {
        $filter_name = Input::get('filter_name');
        $filter_day  = Input::get('filter_day');
        
        Session::put('registrations_filter_name', $filter_name);
        Session::put('registrations_filter_day',  $filter_day);

        return Redirect::route('admin.registration.index');
    }

    
    /**
     * Removes the list filter values from the session
     * and redirects back to the index to force the 
     * list to be displayed.
     */
    public function resetFilter()
    {
        if (Session::has('registrations_filter_name'))  Session::forget('registrations_filter_name');
        if (Session::has('registrations_filter_day'))   Session::forget('registrations_filter_day');

        return Redirect::route('admin.registration.index');
    }


    /**
     * Retrieves and displays a single registration record.
     */
    public function show($id)
    {
        $registration = Registration::findOrFail($id);

        $this->layout->with('title', 'Registration');
        $this->layout->with('subtitle', 'registration details for ' . $registration->child->name());
        $this->layout->content = 
            View::make('admin/registrations/show')
                    ->with('registration', $registration);
    }


    /**
     * Shows the form for editing a registration.
     */
    public function edit($id)
    {
        $registration = Registration::findOrFail($id);

        $this->layout->with('title', 'Registration');
        $this->layout->with('subtitle', 'registration details for ' . $registration->child->name());
        $this->layout->content = 
            View::make('admin/registrations/edit')
                    ->with('registration', $registration);
    }


    /**
     * Updates a registration.
     */
    public function update($id)
    {
        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                Registration::$rules);

        if ($validator->passes()) 
        {
            $registration = Registration::findOrFail($id);
            $registration->update($input);

            return Redirect::route('admin.registration.show', $id);
        }

        return Redirect::route('admin.registration.edit', $id)
            ->withInput()
            ->withErrors($validator);
    }


    /**
     * Deletes a registration.
     */
    public function destroy($id)
    {
        Registration::destroy($id);

        return Redirect::route('admin.registration.index');
    }

}
<?php

namespace Registration;

use Child;
use Registration;

use Log;
use Input;
use Redirect;
use Validator;
use View;

class HomeController extends RegistrationBaseController {


    /**
     * Displays the registration page.
     */
    public function index()
    {
        $this->layout->with('title', 'Registration');
        $this->layout->with('subtitle', '');

        $this->layout->content = View::make('registration/index');
    }


    /**
     * Performs a search and displays the results.
     */
    public function search()
    {
        $name   = Input::get('name');

        if (empty($name)) {
            return 
                Redirect::route('registration.home')
                    ->with('message', 'You must provide a name');
        } 

        $children = Child::where(function($query) use($name) {
            $query->where('children.first_name', 'LIKE', "%$name%")
                  ->orWhere('children.last_name', 'LIKE', "%$name%");
        })->get();

        $child_count = $children->count();

        if ($child_count == 0) {

            return 
                Redirect::route('registration.home')
                    ->withInput()
                    ->with('message', 'No matching children found!');

        } else {

            $children->each(function($child) {
                $child->contact_name   = $child->most_recent_contact_name();
                $child->contact_number = $child->most_recent_contact_number();
                $child->notes          = $child->most_recent_notes();
            });

            $this->layout->with('title', 'Registration');
            $this->layout->with('subtitle', 'search results');

            $this->layout->content = 
                View::make('registration/index')
                    ->with('children', $children);
        }
    }


    /**
     * Performs a registration.
     */
    public function register()
    {
        $child_id = Input::get('child_id');

        $input = Input::all();

        $validator = 
            Validator::make(
                $input, 
                Registration::$rules);

        if ($validator->passes()) {

            $child = Child::findOrFail($child_id);

            $child->registrations()->save(
                new Registration(
                    array(
                        'contact_name'      => Input::get('contact_name'),
                        'contact_number'    => Input::get('contact_number'),
                        'notes'             => Input::get('notes'),
                    )
                ));

            $print_label = Input::get('print_label', false);

            if ($print_label) {

                return 
                    Redirect::route(
                        'print.label', 
                        array(
                            'child_id' => $child_id, 
                            'return_url' => rawurlencode(route('registration.home'))
                        ))
                        ->with('info', 'Registration complete!');

            } else {

                return 
                    Redirect::route('registration.home')
                        ->with('info', 'Registration complete!');
            }

        } else {

            $children = Child::where('id', $child_id)->get();

            $children->each(function($child) {
                // Should actually only be one...
                $child->contact_name   = Input::get('contact_name');
                $child->contact_number = Input::get('contact_number');
                $child->notes          = Input::get('notes');
            });

            $this->layout->with('title', 'Registration');
            $this->layout->with('subtitle', 'search results');

            $this->layout->content = 
                View::make('registration/index')
                    ->with('children', $children)
                    ->with('errors', $validator->messages());
            $this->layout->errors = $validator->messages();
        }
    }

}
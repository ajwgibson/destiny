<?php

class LoginController extends BaseController {

    protected $layout = 'layouts/registration';


    public function showLogin()
    {
        $this->layout->with('title', 'Login');
        $this->layout->with('subtitle', '');
        $this->layout->content = View::make('login');
    }


    public function doLogin()
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );

        $input = Input::get();

        $validator = Validator::make($input, $rules);

        if ($validator->fails())
        {
            return 
                Redirect::route('login')
                    ->withInput()
                    ->withErrors($validator);
        }

        $username = Input::get('username');
        $password = Input::get('password');

        if (Auth::attempt(array('username' => $username, 'password' => $password)))
        {
            $admin = Auth::user()->admin;
            if ($admin) return Redirect::intended(route('admin.home'));
            else return Redirect::intended(route('registration.home'));
        }
        else
        {
            return 
                Redirect::route('login')
                    ->withInput()
                    ->withMessage("Sorry, those credentials didn't work. Please try again.");
        }
    }


    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }

}
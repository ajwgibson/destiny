<?php

namespace Registration;

use View;

class HomeController extends RegistrationBaseController {

    public function index()
    {
        $this->layout->with('title', 'Registration');
        $this->layout->with('subtitle', '');

        $this->layout->content = View::make('registration/index');
    }

}
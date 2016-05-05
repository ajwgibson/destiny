<?php 

namespace Admin;

use Controller;
use View;

class HomeController extends AdminBaseController {

    protected $title = 'Site administration';

    public function index()
    {
        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', '');

        $this->layout->content = View::make('admin/index');
    }

}
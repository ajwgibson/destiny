<?php 

class HomeController extends BaseController {

    public function index()
    {
        $this->layout->content = View::make('home');
    }

    public function faqs()
    {
        $faqs = FAQ::orderBy('position')->orderBy('id')->get();
        $this->layout->content = View::make('faqs')->with('faqs', $faqs);
    }
}
<?php 

namespace Admin;

use FAQ;    // Model

use DB;
use Input;
use Redirect;
use Validator;
use View;

class FAQController extends AdminBaseController {

    protected $title = 'Frequently asked questions';


    /**
     * Display a list of FAQs.
     */
    public function index()
    {
        $faqs = FAQ::orderBy('position')->orderBy('id')->get();

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show all');

        $this->layout->content =
            View::make('admin/faqs/index')
                ->with('faqs', $faqs);
    }


    /**
     * Show the form for creating a new FAQ.
     */
    public function create()
    {
        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'create FAQ');

        $this->layout->content =
            View::make('admin/faqs/create')
                ->with('faq', new FAQ());
    }


    /**
     * Store a newly created FAQ in storage.
     */
    public function store()
    {
        $input = Input::all();

        $validator = Validator::make($input, FAQ::$validation_rules);

        if ($validator->fails()) {
            return 
                Redirect::route('admin.faq.create')
                    ->withInput()
                    ->withErrors($validator);
        }

        $position = DB::table('faqs')->max('position');
        
        if ($position) $position = $position + 1;
        else $position = 1;

        $faq = new FAQ($input);
        $faq->position = $position;
        $faq->save();

        return Redirect::route('admin.faq.index')->withMessage('FAQ created');
    }


    /**
     * Display the specified FAQ.
     */
    public function show($id)
    {
        $faq = FAQ::findOrFail($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show FAQ');

        $this->layout->content =
            View::make('admin/faqs/show')
                ->with('faq', $faq);
    }


    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit($id)
    {
        $faq = FAQ::findOrFail($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'edit FAQ');

        $this->layout->content =
            View::make('admin/faqs/edit')
                ->with('faq', $faq);
    }


    /**
     * Update the specified FAQ in storage.
     */
    public function update($id)
    {
        $input = Input::all();

        $validator = Validator::make($input, FAQ::$validation_rules);

        if ($validator->fails()) {
            return 
                Redirect::route('admin.faq.edit')
                    ->withInput()
                    ->withErrors($validator);
        }

        $faq = FAQ::findOrFail($id);
        $faq->update($input);

        return Redirect::route('admin.faq.show', $id)->withMessage('FAQ updated');
    }


    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy($id)
    {
        FAQ::destroy($id);
        return Redirect::route('admin.faq.index')->withMessage('FAQ deleted');
    }


    /**
     * Move a specified FAQ up the list.
     */
    public function up($id)
    {
        DB::transaction(function() use($id) {

            $faq = FAQ::findOrFail($id);

            $predecessor = 
                FAQ::where('position', '<', $faq->position)
                    ->orderBy('position', 'DESC')
                    ->first();

            if ($predecessor) {
                $tmp = $predecessor->position;
                $predecessor->position = $faq->position;
                $faq->position = $tmp;
                $predecessor->save();
                $faq->save();
            }

        });

        return Redirect::route('admin.faq.index');
    }

    /**
     * Move a specified FAQ down the list.
     */
    public function down($id)
    {
        DB::transaction(function() use($id) {

            $faq = FAQ::findOrFail($id);

            $successor = 
                FAQ::where('position', '>', $faq->position)
                    ->orderBy('position')
                    ->first();

            if ($successor) {
                $tmp = $successor->position;
                $successor->position = $faq->position;
                $faq->position = $tmp;
                $successor->save();
                $faq->save();
            }

        });

        return Redirect::route('admin.faq.index');
    }

}
<?php 

namespace Admin;

use Voucher;

use Hash;
use Input;
use Redirect;
use Session;
use Validator;
use View;

class VoucherController extends AdminBaseController {

    protected $title = 'Vouchers';

    //
    // Shows a list of vouchers
    //
    public function index()
    {
        $vouchers = Voucher::with('order')->orderBy('created_at', 'DESC');

        $filtered = false;
        $filter_code   = Session::get('admin_voucher_filter_code',   '');
        $filter_used   = Session::get('admin_voucher_filter_used',   '');
        $filter_unused = Session::get('admin_voucher_filter_unused', '');

        if (!(empty($filter_code))) {
            $vouchers = $vouchers->where('vouchers.code', $filter_code);
            $filtered = true;
        }

        if (!(empty($filter_used))) {
            $vouchers = $vouchers->whereNotNull('vouchers.order_id');
            $filtered = true;
        }

        if (!(empty($filter_unused))) {
            $vouchers = $vouchers->whereNull('vouchers.order_id');
            $filtered = true;
        }

        $vouchers = $vouchers->paginate(30);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show all vouchers');

        $this->layout->content =
            View::make('admin/vouchers/index')
                ->with('filtered',       $filtered)
                ->with('filter_code',    $filter_code)
                ->with('filter_used',    $filter_used)
                ->with('filter_unused',  $filter_unused)
                ->with('vouchers',       $vouchers);
    }


    //
    // Changes the voucher list filter
    //
    public function filter()
    {
        $filter_code   = Input::get('filter_code');
        $filter_used   = Input::get('filter_used');
        $filter_unused = Input::get('filter_unused');

        // Prevent silly filter combination
        if ($filter_used && $filter_unused) {
            $filter_used   = false;
            $filter_unused = false;
        }

        Session::put('admin_voucher_filter_code',   $filter_code);
        Session::put('admin_voucher_filter_used',   $filter_used);
        Session::put('admin_voucher_filter_unused', $filter_unused);

        return Redirect::route('admin.voucher.index');
    }


    //
    // Resets the voucher list filter
    //
    public function resetFilter()
    {
        if (Session::has('admin_voucher_filter_code'))   Session::forget('admin_voucher_filter_code');
        if (Session::has('admin_voucher_filter_used'))   Session::forget('admin_voucher_filter_used');
        if (Session::has('admin_voucher_filter_unused')) Session::forget('admin_voucher_filter_unused');

        return Redirect::route('admin.voucher.index');
    }


    //
    // Shows the details of an voucher
    //
    public function show($id)
    {
        $voucher = Voucher::findOrFail($id);

        $this->layout->with('title',    $this->title);
        $this->layout->with('subtitle', "voucher details for {$voucher->code}");

        $this->layout->content =
            View::make('admin/vouchers/show')
                ->with('voucher', $voucher);
    }


    //
    // Shows the form to add one or more new vouchers
    //
    public function create()
    {
        $voucher = new Voucher();
        $voucher->batch_size  = 10;
        $voucher->discount    = 50;
        $voucher->child_limit = 5;

        $this->layout->with('title',    $this->title);
        $this->layout->with('subtitle', "add new vouchers");

        $this->layout->content =
            View::make('admin/vouchers/create')
                ->with('voucher',  $voucher);
    }


    //
    // Adds one or more new vouchers
    //
    public function store()
    {
        $input = Input::all();

        $validator = Validator::make(
            $input, 
            Voucher::$validation_rules + array('batch_size' => 'required|min:1|max:50'));

        if ($validator->fails()) {
            return 
                Redirect::route('admin.voucher.create')
                    ->withInput()
                    ->withErrors($validator);
        }

        $input      = Input::except('batch_size');
        $batch_size = Input::get('batch_size');

        for ($i = 0; $i < $batch_size; $i++) {
            $voucher = new Voucher($input);
            $voucher->code = substr(uniqid(), -7);
            $voucher->save();
            usleep(50000);
        }

        return Redirect::route('admin.voucher.index');
    }

    //
    // Shows the form to edit vouchers
    //
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);

        if ($voucher->order) {
            return 
                Redirect::route('admin.voucher.show', array($id))
                    ->withMessage("Sorry, you can't edit a voucher that has already been used on an order.");
        }

        $this->layout->with('title',    $this->title);
        $this->layout->with('subtitle', "edit voucher {$voucher->code}");

        $this->layout->content =
            View::make('admin/vouchers/edit')
                ->with('voucher',  $voucher);
    }


    //
    // Updates a voucher
    //
    public function update($id)
    {
        $voucher = Voucher::findOrFail($id);

        if ($voucher->order) {
            return 
                Redirect::route('admin.voucher.show', array($id))
                    ->withMessage("Sorry, you can't edit a voucher that has already been used on an order.");
        }

        $input = Input::all();

        $validator = Validator::make($input, Voucher::$validation_rules);

        if ($validator->fails()) {
            return 
                Redirect::route('admin.voucher.edit', array($id))
                    ->withInput()
                    ->withErrors($validator);
        }

        $voucher->update($input);

        return Redirect::route('admin.voucher.show', array($id));
    }


    //
    // Deletes a voucher
    //
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        if ($voucher->order_id) {
            return Redirect::route('admin.voucher.show', array($id))
                    ->withMessage('A voucher that is linked to an order cannot be deleted');
        }

        Voucher::destroy($id);
        return Redirect::route('admin.voucher.index');
    }

}
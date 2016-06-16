<?php 

namespace Admin;

use Child;

use Input;
use Redirect;
use Session;
use View;

class ChildController extends AdminBaseController {

    protected $title = 'Children';

    //
    // Shows a list of children
    //
    public function index()
    {
        $children = Child::confirmed()
                        ->with('order')
                        ->orderBy('last_name')
                        ->orderBy('first_name');

        $filtered = false;
        $filter_name   = Session::get('admin_child_filter_name',   '');

        if (!(empty($filter_name))) {

            $children = $children->where(function($query) use($filter_name) {
                $query->where('children.first_name', 'LIKE', "%$filter_name%")
                      ->orWhere('children.last_name', 'LIKE', "%$filter_name%");
            });

            $filtered = true;
        }

        $children = $children->paginate(30);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'confirmed list');

        $this->layout->content =
            View::make('admin/children/index')
                ->with('filtered',       $filtered)
                ->with('filter_name',    $filter_name)
                ->with('children',       $children);
    }


    //
    // Changes the child list filter
    //
    public function filter()
    {
        $filter_name   = Input::get('filter_name');

        Session::put('admin_child_filter_name',   $filter_name);

        return Redirect::route('admin.child.index');
    }


    //
    // Resets the child list filter
    //
    public function resetFilter()
    {
        if (Session::has('admin_child_filter_name'))   Session::forget('admin_child_filter_name');

        return Redirect::route('admin.child.index');
    }


}
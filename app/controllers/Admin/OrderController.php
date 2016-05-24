<?php 

namespace Admin;

use Order;

use Hash;
use Input;
use Redirect;
use Session;
use Validator;
use View;

class OrderController extends AdminBaseController {

    protected $title = 'Orders';

    //
    // Shows a list of orders
    //
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC');

        $filtered = false;
        $filter_name  = Session::get('admin_order_filter_name',  '');
        $filter_email = Session::get('admin_order_filter_email', '');

        if (!(empty($filter_name))) {
            $orders = $orders->where(function($query) use($filter_name) {
                $query->where('orders.first_name', 'LIKE', "%$filter_name%")
                      ->orWhere('orders.last_name', 'LIKE', "%$filter_name%");
            }); 
            $filtered = true;
        }

        if (!(empty($filter_email))) {
            $orders = $orders->where('orders.email', 'LIKE', "%$filter_email%");
            $filtered = true;
        }

        $orders = $orders->paginate(30);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show all orders');

        $this->layout->content =
            View::make('admin/orders/index')
                ->with('filtered',     $filtered)
                ->with('filter_name',  $filter_name)
                ->with('filter_email', $filter_email)
                ->with('orders',       $orders);
    }


    //
    // Changes the order list filter
    //
    public function filter()
    {
        $filter_name  = Input::get('filter_name');
        $filter_email = Input::get('filter_email');

        Session::put('admin_order_filter_name',  $filter_name);
        Session::put('admin_order_filter_email', $filter_email);

        return Redirect::route('admin.order.index');
    }


    //
    // Resets the order list filter
    //
    public function resetFilter()
    {
        if (Session::has('admin_order_filter_name'))  Session::forget('admin_order_filter_name');
        if (Session::has('admin_order_filter_email')) Session::forget('admin_order_filter_email');

        return Redirect::route('admin.order.index');
    }


    //
    // Shows the details of an order
    //
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $this->layout->with('title',    $this->title);
        $this->layout->with('subtitle', "order details for {$order->name()}");

        $this->layout->content =
            View::make('admin/orders/show')
                ->with('order', $order);
    }


    //
    // Deletes an order
    //
    public function destroy($id)
    {
        Order::destroy($id);
        return Redirect::route('admin.order.index');
    }

}
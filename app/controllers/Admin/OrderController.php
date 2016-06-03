<?php 

namespace Admin;

use Child;
use Order;
use Voucher;

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


    //
    // Show the contact details form (the first in the wizard)
    //
    public function contactDetails($transaction_id = NULL)
    {
        if ($transaction_id) $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        else $order = new Order();
        
        $this->layout->with('title', 'Order form');
        $this->layout->with('subtitle', 'contact details');
        
        $this->layout->content = 
            View::make('admin/orders/contact_details')
                ->with('order', $order);
    }


    //
    // Save the contact details form - either a new order or update to an existing order
    //
    public function doContactDetails($transaction_id = NULL)
    {
        $input = Input::all();

        $validator = Validator::make($input, Order::$update_contact_details_rules); // Works here because no email address

        if ($validator->fails()) {
            return 
                Redirect::route('admin.order.contact_details', array($transaction_id))
                    ->withInput()
                    ->withErrors($validator);
        }

        if ($transaction_id) {
            $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
            $order->update($input);
        } else {
            $order = new Order($input);
            $order->transaction_id = uniqid();
            $order->status = Order::StatusCash;
            $order->save();
        }

        return Redirect::route('admin.order.children', array($order->transaction_id));
    }


    //
    // Show the list of children included on the order and provide a mechanism 
    // to add, update or remove them.
    //
    public function children($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $this->layout->with('title', 'Order form');
        $this->layout->with('subtitle', 'children');

        $this->layout->content = 
            View::make('admin/orders/children')
                ->with('order', $order);
    }


    //
    // Show a form to add or edit a child
    //
    public function child($transaction_id, $child_id=null)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        if ($child_id) $child = Child::where('order_id', $order->id)->where('id', $child_id)->firstOrFail();
        else $child = new Child();

        $this->layout->with('title', 'Order form');
        $this->layout->with('subtitle', 'add a child');

        $this->layout->content = 
            View::make('admin/orders/child')
                ->with('child', $child)
                ->with('order', $order);
    }


    //
    // Add or update a child
    //
    public function doChild($transaction_id, $child_id=null)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $input = Input::all();

        if (!Input::has('sleepover'))      $input['sleepover'] = 0;
        if (!Input::has('dancing'))        $input['dancing'] = 0;

        $validator = Validator::make($input, Child::$validation_rules, Child::$validation_messages);

        if ($validator->fails()) {
            return 
                Redirect::route('admin.order.child', array($transaction_id, $child_id))
                    ->withInput()
                    ->withErrors($validator);
        }

        // Don't set the "health_warning" value until after the validation as it breaks :(
        if (!Input::has('health_warning')) $input['health_warning'] = 0;

        if ($child_id) {

            $child = Child::where('order_id', $order->id)->where('id', $child_id)->firstOrFail();
            $child->update($input);

        } else {

            $child = new Child($input);
            $order->children()->save($child);
        }

        return Redirect::route('admin.order.children', array($transaction_id));
    }

    //
    // Show a form to remove a child
    //
    public function removeChild($transaction_id, $child_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        $child = Child::where('order_id', $order->id)->where('id', $child_id)->firstOrFail();

        $this->layout->with('title', 'Order form');
        $this->layout->with('subtitle', 'remove a child');

        $this->layout->content = 
            View::make('admin/orders/remove_child')
                ->with('child', $child)
                ->with('order', $order);
    }


    //
    // Remove a child from the order
    //
    public function doRemoveChild($transaction_id, $child_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        $child = Child::where('order_id', $order->id)->where('id', $child_id)->firstOrFail();
        $child->delete();
        return Redirect::route('admin.order.children', array($transaction_id));
    }


    //
    // Show the permissions form
    //
    public function permissions($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $this->layout->with('title', 'Order form');
        $this->layout->with('subtitle', 'permissions');

        $this->layout->content = 
            View::make('admin/orders/permissions')
                ->with('order', $order);
    }


    //
    // Update the permissions stored on the order
    //
    public function doPermissions($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $input = Input::all();

        $validator = Validator::make($input, Order::$permission_rules);

        if ($validator->fails()) {
            return 
                Redirect::route('admin.order.permissions', array($transaction_id))
                    ->withInput()
                    ->withErrors($validator);
        }

        $order->update($input);

        return Redirect::route('admin.order.voucher', array($transaction_id));
    }


    //
    // Show the voucher form
    //
    public function voucher($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $this->layout->with('title', 'Order form');
        $this->layout->with('subtitle', 'voucher details');

        $this->layout->content = 
            View::make('admin/orders/voucher')
                ->with('order', $order);
    }


    //
    // Proceed from the voucher screen
    //
    public function doVoucher($transaction_id)
    {
        return Redirect::route('admin.order.summary', array($transaction_id));
    }


    //
    // Apply a voucher code
    //
    public function doApplyVoucher($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        
        $code = Input::get('code', null);

        $voucher = Voucher::where('code', $code)->where('order_id', null)->first();

        if ($voucher) {
            
            $voucher->order_id = $order->id;
            $voucher->save();

            return 
                Redirect::route('admin.order.voucher', array($transaction_id))
                    ->withSuccess('Voucher applied to order');

        } else {
            return 
                Redirect::route('admin.order.voucher', array($transaction_id))
                    ->withErrors(array('code' => 'Invalid voucher code'));
        }

    }


    //
    // Summary screen
    //
    public function summary($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $this->layout->with('title', 'Order form');
        $this->layout->with('subtitle', 'summary');

        $this->layout->content = 
            View::make('admin/orders/summary')
                ->with('order', $order);
    }


    //
    // Summary screen
    //
    public function doSummary($transaction_id)
    {
        if (!Input::has('paid_in_full')) {
            return 
                Redirect::route('admin.order.summary', array($transaction_id))
                    ->withErrors(array('paid_in_full' => 'You must confirm payment'));
        }

        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        $order->amount_paid = $order->total();
        $order->status = Order::StatusComplete;
        $order->save();

        return Redirect::route('admin.order.index')
            ->withInfo('Order completed successfully.');
    }

}
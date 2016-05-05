<?php 

class OrderController extends BaseController {

    //
    // Show the contact details form (the first in the wizard)
    //
    public function contactDetails($transaction_id = NULL)
    {
        if ($transaction_id) $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        else $order = new Order();

        $this->layout->content = 
            View::make('orders/contact_details')
                ->with('order', $order)
                ->with('title', 'Order form')
                ->with('subtitle', 'contact details');
    }


    //
    // Save the contact details form - either a new order or update to an existing order
    //
    public function doContactDetails($transaction_id = NULL)
    {
        $input = Input::all();

        $validator = Validator::make($input, Order::$contact_details_rules);

        if ($validator->fails()) {
            return 
                Redirect::route('order.contact_details')
                    ->withInput()
                    ->withErrors($validator);
        }

        if ($transaction_id) {
            $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
            $order->update($input);
        } else {
            $order = new Order($input);
            $order->transaction_id = uniqid();
            $order->save();

            $transaction_id = $order->transaction_id;
        }

        return Redirect::route('order.permissions', array($transaction_id));
    }


    //
    // Show the permissions form
    //
    public function permissions($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $this->layout->content = 
            View::make('orders/permissions')
                ->with('order', $order)
                ->with('title', 'Order form')
                ->with('subtitle', 'permissions');
    }


    //
    // Update the permissions stored on the order
    //
    public function doPermissions($transaction_id)
    {
        $input = Input::all();

        $validator = Validator::make($input, Order::$permission_rules);

        if ($validator->fails()) {
            return 
                Redirect::route('order.permissions', array($transaction_id))
                    ->withInput()
                    ->withErrors($validator);
        }

        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        $order->update($input);

        return Redirect::route('order.confirmation', array($transaction_id));
    }


    //
    // Show the confirmation screen at the end of the process
    //
    public function confirmation($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $this->layout->content = 
            View::make('orders/confirmation')
                ->with('order', $order)
                ->with('title', 'Order form')
                ->with('subtitle', 'confirmation');
    }

}
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

            return Redirect::route('order.children', array($transaction_id));

        } else {

            $order = new Order($input);
            $order->transaction_id = uniqid();
            $order->verification_code = uniqid();
            $order->save();

            Session::put('transaction_id', $order->transaction_id);

            Mail::send(
                array('emails.order.verification', 'emails.order.verification-plain'),
                array('verification_code' => $order->verification_code),
                function($message) use($order) {
                    $message
                        ->to($order->email)
                        ->subject('Destiny Island email address verification');
                });

            return Redirect::route('order.verification', array($order->transaction_id));
        }
    }


    //
    // Show the verification screen where the user enters a code emailed to them
    // to prove that the email address they entered is valid and theirs
    //
    public function verification($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $this->layout->content = 
            View::make('orders/verification')
                ->with('transaction_id', $transaction_id)
                ->with('title', 'Order form')
                ->with('subtitle', 'email verification');
    }


    //
    // Verify that the code entered by the user is correct.
    //
    public function doVerification($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $input = Input::all();

        $rules = array('verification_code' => 'required|max:13');

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return 
                Redirect::route('order.verification', array($transaction_id))
                    ->withErrors($validator);
        }

        $code = Input::get('verification_code');

        $order = Order::where('transaction_id', $transaction_id)
                    ->where('verification_code', $code)
                    ->first();

        if ($order) {

            $order->verification_code = NULL;
            $order->save();

            Session::put('transaction_id', $order->transaction_id);

            $link = route('order.contact_details', array($transaction_id));

            Mail::send(
                array('emails.order.order-link', 'emails.order.order-link-plain'),
                array('order_link' => $link),
                function($message) use($order) {
                    $message
                        ->to($order->email)
                        ->subject('Destiny Island');
                });

            return Redirect::route('order.children', array($transaction_id));
        } 

        return 
            Redirect::route('order.verification', array($transaction_id))
                ->withMessage('Sorry, that code is not correct');
    }


    //
    // Display the authenticate form to allow a customer back
    // into a transaction from a new browser session
    //
    public function authentication($transaction_id)
    {
        $this->layout->content = 
            View::make('orders/authentication')
                ->with('transaction_id', $transaction_id)
                ->with('title', 'Order form')
                ->with('subtitle', 'authenticate user');
    }


    //
    // Authenticate the user before letting them return to an order
    //
    public function doAuthentication($transaction_id)
    {
        $email = Input::get('email');
        $order = Order::where('transaction_id', $transaction_id)
                    ->where('email', $email)
                    ->firstOrFail();
        Session::put('transaction_id', $transaction_id);
        return Redirect::route('order.contact_details', array($transaction_id));
    }


    //
    // Show the list of children included on the order and provide a mechanism 
    // to add, update or remove them.
    //
    public function children($transaction_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $this->layout->content = 
            View::make('orders/children')
                ->with('order', $order)
                ->with('title', 'Order form')
                ->with('subtitle', 'children');
    }


    //
    // Show a form to add or edit a child
    //
    public function child($transaction_id, $child_id=null)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        if ($child_id) $child = Child::where('order_id', $order->id)->where('id', $child_id)->firstOrFail();
        else $child = new Child();

        $this->layout->content = 
            View::make('orders/child')
                ->with('child', $child)
                ->with('order', $order)
                ->with('title', 'Order form')
                ->with('subtitle', 'add a child');
    }


    //
    // Add or update a child
    //
    public function doChild($transaction_id, $child_id=null)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $input = Input::all();
        if (!Input::has('sleepover')) $input['sleepover'] = 0;

        $validator = Validator::make($input, Child::$validation_rules);

        if ($validator->fails()) {
            return 
                Redirect::route('order.child', array($transaction_id, $child_id))
                    ->withInput()
                    ->withErrors($validator);
        }

        if ($child_id) {

            $child = Child::where('order_id', $order->id)->where('id', $child_id)->firstOrFail();
            $child->update($input);

        } else {

            $child = new Child($input);
            $order->children()->save($child);
        }

        return Redirect::route('order.children', array($transaction_id));
    }

    //
    // Show a form to remove a child
    //
    public function removeChild($transaction_id, $child_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        $child = Child::where('order_id', $order->id)->where('id', $child_id)->firstOrFail();

        $this->layout->content = 
            View::make('orders/remove_child')
                ->with('child', $child)
                ->with('order', $order)
                ->with('title', 'Order form')
                ->with('subtitle', 'remove a child');
    }


    //
    // Remove a child from the order
    //
    public function doRemoveChild($transaction_id, $child_id)
    {
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();
        $child = Child::where('order_id', $order->id)->where('id', $child_id)->firstOrFail();
        $child->delete();
        return Redirect::route('order.children', array($transaction_id));
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
        $order = Order::where('transaction_id', $transaction_id)->firstOrFail();

        $input = Input::all();

        $validator = Validator::make($input, Order::$permission_rules);

        if ($validator->fails()) {
            return 
                Redirect::route('order.permissions', array($transaction_id))
                    ->withInput()
                    ->withErrors($validator);
        }

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
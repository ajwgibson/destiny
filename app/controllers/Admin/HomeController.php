<?php 

namespace Admin;

use Child;
use Order;

use Controller;
use DB;
use Log;
use View;

class HomeController extends AdminBaseController {

    protected $title = 'Site administration';

    public function index()
    {
        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', '');


        // Simple order counts
        $orders_total = Order::where('status', Order::StatusComplete)->count();
        $orders_in_progress = Order::where('status', '<>', Order::StatusComplete)->count();

        $cumulative_orders = 
            DB::table('v_cumulative_orders_by_date')
                ->lists('cumulative_order_count', 'order_date');

        $cumulative_children =
            DB::table('v_cumulative_children_by_date')
                ->lists('cumulative_child_count', 'order_date');

        $cumulative_data = array();

        foreach($cumulative_orders as $key => $val) {
            if (array_key_exists($key, $cumulative_children)) {
                $cumulative_data[] = array(
                    'date' => $key,
                    'orders' => $val,
                    'children' => $cumulative_children[$key]
                );
            }
        }

        // Financials
        $payments_online = 
            Order::where('status', Order::StatusComplete)
                ->whereNotNull('stripe_charge_id')
                ->sum('amount_paid');

        $payments_cash = 
            Order::where('status', Order::StatusComplete)
                ->whereNull('stripe_charge_id')
                ->sum('amount_paid');

        $payments_total =
            Order::where('status', Order::StatusComplete)
                ->sum('amount_paid');


        // Statistics about children
        $children_by_school_year = 
            Child::whereHas('order', function($q) { 
                $q->where('status', Order::StatusComplete); 
            })->select(DB::raw('count(*) as school_year_count, school_year'))
              ->groupBy('school_year')
              ->orderBy('school_year')
              ->get();

        $this->layout->content = 
            View::make('admin/index')
                ->with('orders_total',            $orders_total)
                ->with('orders_in_progress',      $orders_in_progress)
                ->with('cumulative_data',         $cumulative_data)
                ->with('payments_online',         $payments_online)
                ->with('payments_cash',           $payments_cash)
                ->with('payments_total',          $payments_total)
                ->with('children_by_school_year', $children_by_school_year);
    }

}
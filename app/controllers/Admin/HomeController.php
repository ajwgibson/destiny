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


        // Order counts
        $orders_total = Order::confirmed()->count();
        $orders_in_progress = Order::inProgress()->count();

        $cumulative_orders = 
            DB::table('v_cumulative_orders_by_date')
                ->lists('cumulative_order_count', 'order_date');

        $cumulative_children =
            DB::table('v_cumulative_children_by_date')
                ->lists('cumulative_child_count', 'order_date');

        $cumulative_data = array();

        foreach($cumulative_orders as $key => $val) {
            // Only include entries with common dates
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
            Order::confirmed()
                ->whereNotNull('stripe_charge_id')
                ->sum('amount_paid');

        $payments_cash = 
            Order::confirmed()
                ->whereNull('stripe_charge_id')
                ->sum('amount_paid');

        $payments_total =
            Order::confirmed()
                ->sum('amount_paid');


        // Statistics about children
        $children_by_school_year = 
            Child::confirmed()
                ->select(DB::raw('count(*) as school_year_count, school_year'))
                ->groupBy('school_year')
                ->orderBy('school_year')
                ->get();

        // Statistics about activities
        $dancing_data = array(
            'yes' => Child::confirmed()->dancing()->count(),
            'no'  => Child::confirmed()->notDancing()->count()
        );

        $activity_choice_1 =
            Child::confirmed()
                ->notDancing()
                ->select(DB::raw('activity_choice_1, count(id) as activity_choice_1_count'))
                ->groupBy('activity_choice_1')
                ->lists('activity_choice_1_count', 'activity_choice_1');

        $activity_choice_2 =
            Child::confirmed()
                ->notDancing()
                ->select(DB::raw('activity_choice_2, count(id) as activity_choice_2_count'))
                ->groupBy('activity_choice_2')
                ->lists('activity_choice_2_count', 'activity_choice_2');

        $activity_choice_3 =
            Child::confirmed()
                ->notDancing()
                ->select(DB::raw('activity_choice_3, count(id) as activity_choice_3_count'))
                ->groupBy('activity_choice_3')
                ->lists('activity_choice_3_count', 'activity_choice_3');

        // Miscellaneous
        $tshirts = 
            Child::confirmed()
                ->select(DB::raw('tshirt, count(id) as tshirt_count'))
                ->groupBy('tshirt')
                ->lists('tshirt_count', 'tshirt');

        $extra_payments = Order::confirmed()->sum('amount_extra');
        $discounts      = Order::confirmed()->sum('discount');

        $this->layout->content = 
            View::make('admin/index')
                ->with('orders_total',            $orders_total)
                ->with('orders_in_progress',      $orders_in_progress)
                ->with('cumulative_data',         $cumulative_data)
                ->with('payments_online',         $payments_online)
                ->with('payments_cash',           $payments_cash)
                ->with('payments_total',          $payments_total)
                ->with('children_by_school_year', $children_by_school_year)
                ->with('dancing_data',            $dancing_data)
                ->with('activity_choice_1',       $activity_choice_1)
                ->with('activity_choice_2',       $activity_choice_2)
                ->with('activity_choice_3',       $activity_choice_3)
                ->with('tshirts',                 $tshirts)
                ->with('extra_payments',          $extra_payments)
                ->with('discounts',               $discounts);
    }

}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCumulativeDatabaseViews extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(<<<'EOD1'
            create or replace view v_orders_by_date as
                select 
                    date(updated_at) as order_date,
                    count(*) as order_count
                from orders
                where 
                    orders.status=2 
                    and orders.deleted_at is null
                group by order_date
                order by order_date
EOD1
        );

        DB::statement(<<<'EOD2'
            create or replace view v_cumulative_orders_by_date as
                select 
                    od.order_date,
                    (
                        select sum(x.order_count)
                        from v_orders_by_date x 
                        where x.order_date <= od.order_date
                    ) as cumulative_order_count
                from v_orders_by_date od
                order by od.order_date
EOD2
        );

        DB::statement(<<<'EOD3'
            create or replace view v_children_by_date as
                select 
                    date(orders.updated_at) as order_date,
                    count(children.id) as child_count
                from orders join children on orders.id=children.order_id
                where 
                    orders.status=2 
                    and orders.deleted_at is null
                group by order_date
                order by order_date
EOD3
        );

        DB::statement(<<<'EOD4'
            create or replace view v_cumulative_children_by_date as
                select 
                    cd.order_date,
                    (
                        select sum(x.child_count)
                        from v_children_by_date x 
                        where x.order_date <= cd.order_date
                    ) as cumulative_child_count
                from v_children_by_date cd
                order by cd.order_date
EOD4
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW v_cumulative_children_by_date');
        DB::statement('DROP VIEW v_children_by_date');
        DB::statement('DROP VIEW v_cumulative_orders_by_date');
        DB::statement('DROP VIEW v_orders_by_date');
    }

}

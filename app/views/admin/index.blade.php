
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Orders</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <canvas id="myChart" width="250" height="200"></canvas>
            </div>
            <div class="col-sm-3">
                <ul class="list-group">
                    <li class="list-group-item"><h4>Orders</h4></li>
                    <li class="list-group-item"><span class="badge">{{ $orders_in_progress }}</span> In-progress orders</li>
                    <li class="list-group-item"><span class="badge">{{ $orders_total }}</span> Completed orders</li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item"><h4>Payments</h4></li>
                    <li class="list-group-item"><span class="badge money">£{{{ money_format('%#5i', $payments_online) }}}</span> Online</li>
                    <li class="list-group-item"><span class="badge money">£{{{ money_format('%#5i', $payments_cash) }}}</span> Cash</li>
                    <li class="list-group-item list-group-item-success"><span class="badge money">£{{{ money_format('%#5i', $payments_total) }}}</span> Total</li>
                </ul>
            </div>
            <div class="col-sm-3">
                <ul class="list-group">
                    <li class="list-group-item"><h4>Children by school year</h4></li>
                    @foreach($children_by_school_year as $school_year)
                    <li class="list-group-item">
                        <span class="badge">{{ $school_year->school_year_count }}</span> 
                        {{ Child::get_school_year($school_year->school_year) }}
                    </li>
                    @endforeach
                    <li class="list-group-item list-group-item-success">
                        <span class="badge">{{ $children_by_school_year->sum('school_year_count'); }}</span>
                        Total
                    </li>
                </ul>
            </div>
      </div>
  </div>
</div>

@section('extra_js')

<script>
var ctx = document.getElementById("myChart");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {{ json_encode(array_pluck($cumulative_data, 'date')) }},
        datasets: [
            { 
                label: 'Children',
                fill: false,
                borderColor: "rgba(75,192,192,1)",
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                lineTension: 0,
                data: {{ json_encode(array_pluck($cumulative_data, 'children')) }},
            },
            { 
                label: 'Orders',
                fill: false,
                borderColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointBackgroundColor: "rgba(255,99,132,1)",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(255,99,132,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                lineTension: 0,
                data: {{ json_encode(array_pluck($cumulative_data, 'orders')) }},
            }
        ]
    },
    options: {
        scales: {
            xAxes: [
                {
                    type: 'time',
                    time: { 
                        displayFormats: { quarter: 'MMM YYYY' },
                    }
                }
            ]
        }
    }
});
</script>

@stop

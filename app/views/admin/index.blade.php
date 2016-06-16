
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Orders, children &amp; payments</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <canvas id="orderChart" width="250" height="200" style="margin-bottom: 20px;"></canvas>
            </div>
            <div class="col-sm-6 col-md-3">
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

                <ul class="list-group">
                    <li class="list-group-item"><h4>Destiny HighLand</h4></li>
                    <li class="list-group-item"><span class="badge">{{ $sleepover_count }}</span> Tickets sold</li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
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

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Activities</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><h4>Dancing</h4></li>
                    <li class="list-group-item">
                        <canvas id="danceChart" width="50" height="50"></canvas>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><h4>Option 1</h4></li>
                    <li class="list-group-item">
                        <canvas id="optionChart1" width="50" height="50"></canvas>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><h4>Option 2</h4></li>
                    <li class="list-group-item">
                        <canvas id="optionChart2" width="50" height="50"></canvas>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><h4>Option 3</h4></li>
                    <li class="list-group-item">
                        <canvas id="optionChart3" width="50" height="50"></canvas>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Miscellaneous</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><h4>T-Shirts</h4></li>
                    <li class="list-group-item">
                        <canvas id="tshirtChart" width="50" height="50"></canvas>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><h4>Extra payments &amp; discounts</h4></li>
                    <li class="list-group-item"><span class="badge money">£{{{ money_format('%#5i', $extra_payments) }}}</span> Extra payments</li>
                    <li class="list-group-item"><span class="badge money">£{{{ money_format('%#5i', $discounts) }}}</span> Discounts</li>
                    <li class="list-group-item list-group-item-{{ $extra_payments >= $discounts ? 'success' : 'danger' }}"><span class="badge money">£{{{ money_format('%#5i', $extra_payments - $discounts) }}}</span> Balance</li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
            </div>
            <div class="col-sm-6 col-md-3">
            </div>
        </div>
    </div>
</div>

@section('extra_js')

<script>

var colours = {
    gray:   { normal: "rgba(77,  77,  77,  1)", highlight: "rgba(77,  77,  77,  0.9)" },
    blue:   { normal: "rgba(93,  165, 218, 1)", highlight: "rgba(93,  165, 218, 0.9)" },
    orange: { normal: "rgba(250, 164, 58,  1)", highlight: "rgba(250, 164, 58,  0.9)" },
    green:  { normal: "rgba(96,  189, 104, 1)", highlight: "rgba(96,  189, 104, 0.9)" },
    pink:   { normal: "rgba(241, 124, 176, 1)", highlight: "rgba(241, 124, 176, 0.9)" },
    brown:  { normal: "rgba(178, 145, 47,  1)", highlight: "rgba(178, 145, 47,  0.9)" },
    purple: { normal: "rgba(178, 118, 178, 1)", highlight: "rgba(178, 118, 178, 0.9)" },
    yellow: { normal: "rgba(222, 207, 63,  1)", highlight: "rgba(222, 207, 63,  0.9)" },
    red:    { normal: "rgba(241, 88,  84,  1)", highlight: "rgba(241, 88,  84,  0.9)" }
};

var ctxOrderChart = document.getElementById("orderChart");
var orderChart = new Chart(ctxOrderChart, {
    type: 'line',
    data: {
        labels: {{ json_encode(array_pluck($cumulative_data, 'date')) }},
        datasets: [
            { 
                label:                     'Children',
                fill:                      false,
                borderColor:               colours["red"]["normal"],
                pointBorderColor:          colours["red"]["normal"],
                pointBorderWidth:          1,
                pointBackgroundColor:      "#fff",
                pointRadius:               3,
                pointHoverRadius:          5,
                pointHoverBackgroundColor: colours["red"]["normal"],
                pointHoverBorderColor:     colours["red"]["normal"],
                pointHoverBorderWidth:     1,
                pointHitRadius:            10,
                lineTension:               0,
                data: {{ json_encode(array_pluck($cumulative_data, 'children')) }},
            },
            { 
                label:                     'Orders',
                fill:                      false,
                borderColor:               colours["blue"]["normal"],
                pointBorderColor:          colours["blue"]["normal"],
                pointBorderWidth:          1,
                pointBackgroundColor:      "#fff",
                pointRadius:               3,
                pointHoverRadius:          5,
                pointHoverBackgroundColor: colours["blue"]["normal"],
                pointHoverBorderColor:     colours["blue"]["normal"],
                pointHoverBorderWidth:     2,
                pointHitRadius:            10,
                lineTension:               0,
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

var ctxDanceChart = document.getElementById("danceChart");
var danceChart = new Chart(ctxDanceChart, {
    type: 'pie',
    data: {
        labels: ["Yes", "No"],
        datasets: [
        {
            data: [{{ $dancing_data['yes'] }}, {{ $dancing_data['no'] }}],
            backgroundColor: [
                colours["red"]["normal"],
                colours["blue"]["normal"],
            ],
            hoverBackgroundColor: [
                colours["red"]["highlight"],
                colours["blue"]["highlight"],
            ]
        }]
    },
    options: {
        legend: {
            fullWidth: true
        }
    }
});

var ctxOptionChart1 = document.getElementById("optionChart1");
var optionChart1 = new Chart(ctxOptionChart1, {
    type: 'pie',
    data: {
        labels: {{ json_encode(array_keys($activity_choice_1)) }},
        datasets: [
        {
            data: {{ json_encode(array_values($activity_choice_1)) }},
            backgroundColor: [
                colours["red"]["normal"],
                colours["blue"]["normal"],
                colours["gray"]["normal"]
            ],
            hoverBackgroundColor: [
                colours["red"]["highlight"],
                colours["blue"]["highlight"],
                colours["gray"]["highlight"]
            ]
        }]
    },
    options: {
        legend: {
            fullWidth: true
        }
    }
});

var ctxOptionChart2 = document.getElementById("optionChart2");
var optionChart2 = new Chart(ctxOptionChart2, {
    type: 'pie',
    data: {
        labels: {{ json_encode(array_keys($activity_choice_2)) }},
        datasets: [
        {
            data: {{ json_encode(array_values($activity_choice_2)) }},
            backgroundColor: [
                colours["red"]["normal"],
                colours["blue"]["normal"],
                colours["gray"]["normal"]
            ],
            hoverBackgroundColor: [
                colours["red"]["highlight"],
                colours["blue"]["highlight"],
                colours["gray"]["highlight"]
            ]
        }]
    },
    options: {}
});

var ctxOptionChart3 = document.getElementById("optionChart3");
var optionChart3 = new Chart(ctxOptionChart3, {
    type: 'pie',
    data: {
        labels: {{ json_encode(array_keys($activity_choice_3)) }},
        datasets: [
        {
            data: {{ json_encode(array_values($activity_choice_3)) }},
            backgroundColor: [
                colours["red"]["normal"],
                colours["blue"]["normal"],
                colours["gray"]["normal"]
            ],
            hoverBackgroundColor: [
                colours["red"]["highlight"],
                colours["blue"]["highlight"],
                colours["gray"]["highlight"]
            ]
        }]
    },
    options: {}
});

var ctxTshirtChart = document.getElementById("tshirtChart");
var tshirtChart = new Chart(ctxTshirtChart, {
    type: 'pie',
    data: {
        labels: {{ json_encode(array_keys($tshirts)) }},
        datasets: [
        {
            data: {{ json_encode(array_values($tshirts)) }},
            backgroundColor: [
                colours["red"]["normal"],
                colours["blue"]["normal"],
                colours["orange"]["normal"],
                colours["green"]["normal"]
            ],
            hoverBackgroundColor: [
                colours["red"]["highlight"],
                colours["blue"]["highlight"],
                colours["orange"]["highlight"],
                colours["green"]["highlight"]
            ]
        }]
    },
    options: {}
});

</script>

@stop

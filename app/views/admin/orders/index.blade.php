
<div class="pull-right">
    <a class="btn" data-toggle="collapse" data-target="#filter">
        @if ($filtered)
        <span class="glyphicon glyphicon-warning-sign"></span>
        @endif
        Filter orders
        <span class="caret"></span>
    </a>
</div>

<div>
    {{ link_to_route(
        'admin.order.contact_details', 
        'New order', 
        $parameters = array( ), 
        $attributes = array( 'class' => 'btn btn-primary')) }}
</div>

<div class="clearfix"></div>


<div id="filter" class="filter collapse">

    {{ Form::open(array('route' => array('admin.order.filter'))) }}

    <div class="col-sm-8 col-sm-offset-4 panel panel-default">

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_name', 'Contact name', array ('class' => 'control-label')) }}
                <div>
                    {{ Form::text('filter_name', $filter_name, array ('class' => 'form-control')) }}
                </div>
                <p class="help-block">Try a full or partial first or last name, but not both</p>
            </div>

        </div>

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_email', 'Contact email', array ('class' => 'control-label')) }}
                <div>
                    {{ Form::text('filter_email', $filter_email, array ('class' => 'form-control')) }}
                </div>
                <p class="help-block">A full or partial email address</p>
            </div>

        </div>

        <div class="col-sm-6 col-sm-offset-6">
            <div class="pull-right">
            {{ Form::submit('Apply filters', array('class' => 'btn btn-info')) }}

            {{ link_to_route(
                'admin.order.filter.reset', 
                'Reset filters', 
                $parameters = array( ), 
                $attributes = array( 'class' => 'btn btn-default' ) ) }}
            </div>
        </div>

    </div>

    {{ Form::close() }}

</div>



<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Contact name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Children</th>
                        <th>Status</th>
                        <th>Voucher</th>
                        <th>Paid</th>
                        <th>Last updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{{ $order->name() }}}</td>
                        <td>{{{ $order->email }}}</td>
                        <td>{{{ $order->phone }}}</td>
                        <td>
                        @foreach ($order->children as $child)
                            {{{ $child->name() }}}<br/>
                        @endforeach
                        </td>
                        <td>{{{ $order->status() }}}</td>
                        <td>
                            @if ($order->voucher)
                            <code>{{{ $order->voucher->code }}}</code>
                            @endif
                        </td>
                        <td>
                            @if ($order->amount_paid > 0)
                            £{{ money_format('%(#3i', $order->amount_paid) }}
                                @if ($order->cash())
                                <span class="label label-info">cash</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            {{{ Destiny\ViewHelper::london_time($order->updated_at) }}}
                        </td>
                        <td>
                            {{ link_to_route(
                                'admin.order.show', 
                                'Details', 
                                $parameters = array( 'id' => $order->id), 
                                $attributes = array( 'class' => '')) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pull-right">
    {{ $orders->links() }}
</div>

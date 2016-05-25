
<div class="pull-right">
    <a class="btn" data-toggle="collapse" data-target="#filter">
        @if ($filtered)
        <span class="glyphicon glyphicon-warning-sign"></span>
        @endif
        Filter vouchers
        <span class="caret"></span>
    </a>
</div>

<div>
    {{ link_to_route(
        'admin.voucher.create', 
        'Add vouchers', 
        $parameters = array( ), 
        $attributes = array( 'class' => 'btn btn-primary')) }}
</div>

<div class="clearfix"></div>


<div id="filter" class="filter collapse">

    {{ Form::open(array('route' => array('admin.voucher.filter'))) }}

    <div class="col-sm-8 col-sm-offset-4 panel panel-default">

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_code', 'Voucher code', array ('class' => 'control-label')) }}
                <div>
                    {{ Form::text('filter_code', $filter_code, array ('class' => 'form-control')) }}
                </div>
                <p class="help-block">Must be an exact match</p>
            </div>

        </div>

        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label('filter_used', 'Used or unused', array('class' => 'control-label')) }}
                <div>
                    <label class="checkbox-inline">{{ Form::checkbox('filter_used', true, $filter_used) }} Used vouchers</label><br/>
                    <label class="checkbox-inline">{{ Form::checkbox('filter_unused', true, $filter_unused) }} Unused vouchers</label><br/>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-sm-offset-6">
            <div class="pull-right">
            {{ Form::submit('Apply filters', array('class' => 'btn btn-info')) }}

            {{ link_to_route(
                'admin.voucher.filter.reset', 
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Voucher code</th>
                    <th>Discount</th>
                    <th>Limit (children)</th>
                    <th>Order</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vouchers as $voucher)
                <tr>
                    <td><code>{{{ $voucher->code }}}</code></td>
                    <td>{{{ $voucher->discount }}}%</td>
                    <td>{{{ $voucher->child_limit }}}</td>
                    <td>
                    @if ($voucher->order)
                        {{ link_to_route(
                            'admin.order.show', 
                            $voucher->order->name(), 
                            $parameters = array( 'id' => $voucher->order->id), 
                            $attributes = array( 'class' => '')) }}
                    @else
                        <i>Not used yet</i>
                    @endif
                    </td>
                    <td>
                        {{ link_to_route(
                            'admin.voucher.show', 
                            'Show details', 
                            $parameters = array( 'id' => $voucher->id), 
                            $attributes = array( 'class' => '')) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="pull-right">
    {{ $vouchers->links() }}
</div>

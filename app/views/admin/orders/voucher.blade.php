
<div class="row">
            <div class="col-md-8" id="inner-content">

        @if ($order->voucher)

        <div class="row">
            <section class="col-xs-10">
                <p class="lead">
                    Discount voucher <code>{{ $order->voucher->code }}</code> has been applied to this order,
                    resulting in a total discount of <code>£{{ money_format('%i', $order->discount()) }}</code>. 
                    Discounts are only applied to conference passes and not to Destiny HighLand tickets.
                </p>
            </section>
        </div>

        @else

        <div class="row">
            <section class="col-xs-10">
                <p class="lead">
                    Please note that discounts will only be applied to conference passes
                    and not to Destiny HighLand tickets.
                </p>
            </section>
        </div>

        <div class="row">

            <section class="col-xs-10">

                {{ Form::open(array('route' => array('admin.order.voucher.apply.do', $order->transaction_id), 'class' => 'form-inline')) }}

                <div class="form-group {{ $errors->has('code') ? 'has-error' : null }}">
                    {{ Form::label('code', 'Code', array ('class' => 'control-label')) }}
                    {{ Form::text('code', null, array('class' => 'form-control', 'maxlength' => 13)) }}
                </div>
                
                {{ Form::submit('Apply voucher', array('class' => 'btn btn-success')) }}

                {{ Form::close() }}

            </section>

        </div>

        @endif

        {{ Form::model($order, array('route' => array('admin.order.voucher.do', $order->transaction_id))) }}

        <div class="row top-20 bottom-40">
            <section class="col-xs-10">
                {{ HTML::wizard_previous('admin.order.permissions', array('transaction_id' => $order->transaction_id)) }}
                {{ HTML::wizard_next(array('transaction_id' => $order->transaction_id)) }}
            </section>
        </div>

        {{ Form::close() }}

    </div>

    <div class="col-md-4 hidden-print" id="sidebar">
        @include('orders/_sidebar')
    </div>

</div>

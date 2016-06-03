
<div class="row">
    <div class="col-md-8" id="inner-content">

        <div class="row">
            <section class="col-xs-10">
                <p class="lead">
                    Please double check the contents of the order and confirm that
                    the full amount has been paid.
                </p>
            </section>
        </div>

        <div class="row">
            <section class="col-xs-8 order-summary">
                @include('orders/_summary')
            </section>
        </div>


        {{ Form::model($order, array('route' => array('admin.order.summary.do', $order->transaction_id))) }}


        <div class="row top-20">
            <div class="col-xs-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group {{ $errors->has('paid_in_full') ? 'has-error' : null }}">
                            <label for="paid_in_full" class="control-label">{{{ Destiny\ViewHelper::required_icon() }}} 
                                I confirm that the balance has been paid in full</label>
                            <div>
                                <label class="checkbox-inline">{{ Form::checkbox('paid_in_full', true) }} Yes</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row top-20 bottom-40">
            <section class="col-xs-10">
                {{ HTML::wizard_previous('admin.order.voucher', array('transaction_id' => $order->transaction_id)) }}
                {{ Form::submit('Finish order', array ('class' => 'btn btn-primary pull-right')) }} 
            </section>
        </div>

        {{ Form::close() }}

    </div>

    <div class="col-md-4 hidden-print" id="sidebar">
    </div>

</div>
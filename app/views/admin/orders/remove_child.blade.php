
<div class="row">
    <div class="col-md-8" id="inner-content">

        <p class="lead">
            Please confirm that you want to remove {{{ $child->first_name }}} from this order.
        </p>

        {{ Form::model($child, array('route' => array('admin.order.remove.child.do', $order->transaction_id, $child->id))) }}

        <div class="row top-20">
            <section class="col-xs-6">
                {{ Form::submit('Yes, remove ' . $child->first_name, array ('class' => 'btn btn-danger')) }} 
                {{ link_to_route(
                    'admin.order.children', 
                    'No, do not remove ' . $child->first_name, 
                    $parameters = array('transaction_id' => $order->transaction_id), 
                    $attributes = array('class' => 'btn btn-default')) }}
            </section>
        </div>

        {{ Form::close() }}

    </div>

    <div class="col-md-4 hidden-print" id="sidebar">
        @include('orders/_sidebar')
    </div>

</div>
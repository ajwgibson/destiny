
<div class="row">
    <div class="col-md-8" id="inner-content">

        {{ Form::model($child, array('route' => array('admin.order.child.do', $order->transaction_id, $child->id))) }}

        @include('admin/orders/_child')

        <div class="row top-20">
            <section class="col-xs-6">
                {{ Form::submit('Save', array ('class' => 'btn btn-primary')) }} 
                {{ link_to_route(
                    'admin.order.children', 
                    'Cancel', 
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


@section('extra_js')

@include('admin/orders/_child_js')

@stop
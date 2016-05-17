
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<p class="lead">
    Please confirm that you want to remove {{{ $child->first_name }}} from this order.
</p>

{{ Form::model($child, array('route' => array('order.remove.child.do', $order->transaction_id, $child->id))) }}

<div class="row top-20">
    <section class="col-xs-6">
        {{ Form::submit('Yes, remove ' . $child->first_name, array ('class' => 'btn btn-danger')) }} 
        {{ link_to_route(
            'order.children', 
            'No, do not remove ' . $child->first_name, 
            $parameters = array('transaction_id' => $order->transaction_id), 
            $attributes = array('class' => 'btn btn-default')) }}
    </section>
</div>

{{ Form::close() }}

@stop


@section('sidebar')

@include('orders/_sidebar')

@stop


@section('extra_js')

@stop
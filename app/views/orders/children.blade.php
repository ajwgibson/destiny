
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

@if ($order->children->count() == 0)
    <p class="lead">
        You haven't added any children to your order yet. 
    </p>
    <p>
    {{ link_to_route(
            'order.child', 
            'Add a child', 
            $parameters = array('transaction_id' => $order->transaction_id), 
            $attributes = array('class' => 'btn btn-success')) }}
    </p>
@else
    <p class="lead">
        These are the children currently associated with your order.
    </p>
    <p>
    {{ link_to_route(
            'order.child', 
            'Add a child', 
            $parameters = array('transaction_id' => $order->transaction_id), 
            $attributes = array('class' => 'btn btn-success')) }}
    </p>

    <div class="row">
        <div class="col-sm-6">
            <ul class="list-group">
                @foreach ($order->children as $child)
                <li class="list-group-item" style="margin-bottom: 10px;">
                    
                    <h4>{{{ $child->first_name . ' ' . $child->last_name }}}</h4>
                    <div style="margin-top: 10px;">
                        <p><i>{{{ $child->first_name }}} will be {{ $child->age() }} years old on August 3rd</i></p>
                        <p><i>
                        @if ($child->age() > 9)
                        {{{ $child->first_name}}} is {{{ $child->sleepover ? '' : 'not ' }}} attending the sleepover.
                        @else
                        {{{ $child->first_name}}} is not old enough to attend the sleepover.
                        @endif
                        </i></p>
                        <a href="{{ route('order.child', 
                                        array(
                                            'transaction_id' => $order->transaction_id,
                                            'child_id' => $child->id)) }}" 
                           class="btn btn-xs btn-link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                        <a href="{{ route('order.remove.child', 
                                        array(
                                            'transaction_id' => $order->transaction_id,
                                            'child_id' => $child->id)) }}" 
                           class="btn btn-xs btn-link"><span class="text-danger"><span class="glyphicon glyphicon-remove"></span> Remove</span></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>    </div>
@endif

<div class="row top-20">
    <section class="col-xs-12">
        {{ HTML::wizard_previous('order.contact_details', array('transaction_id' => $order->transaction_id)) }}
        {{ HTML::wizard_next_link(
            'order.permissions', 
            $order->children->count() > 0 ? false : true, 
            array('transaction_id' => $order->transaction_id)) }}
    </section>
</div>

@stop


@section('sidebar')

@include('orders/_summary')

@stop
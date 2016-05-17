
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')


@if ($order->voucher)

<div class="row">
    <section class="col-xs-10">
        <p class="lead">
            Discount voucher <code>{{ $order->voucher->code }}</code> has been applied to this order,
            resulting in a total discount of <code>£{{ money_format('%i', $order->discount()) }}</code>. Please 
            note that discounts will only be applied to daytime tickets and not to sleepover tickets.
        </p>
    </section>
</div>

@else

<div class="row">
    <section class="col-xs-10">
        <p class="lead">
            If you have a discount voucher please use it now. Only one voucher can be used
            on an order and a voucher can only be used once. If you do not have a voucher, please 
            proceed to the next step. Please note that discounts will only be applied to daytime tickets
            and not to sleepover tickets.
        </p>
    </section>
</div>

<div class="row">

    <section class="col-xs-10">

        {{ Form::open(array('route' => array('order.voucher.apply.do', $order->transaction_id), 'class' => 'form-inline')) }}

        <div class="form-group {{ $errors->has('code') ? 'has-error' : null }}">
            {{ Form::label('code', 'Code', array ('class' => 'control-label')) }}
            {{ Form::text('code', null, array('class' => 'form-control', 'maxlength' => 13)) }}
        </div>
        
        {{ Form::submit('Apply voucher', array('class' => 'btn btn-success')) }}

        {{ Form::close() }}

    </section>

</div>

@endif

{{ Form::model($order, array('route' => array('order.voucher.do', $order->transaction_id))) }}

<div class="row top-20 bottom-40">
    <section class="col-xs-10">
        {{ HTML::wizard_previous('order.permissions', array('transaction_id' => $order->transaction_id)) }}
        {{ HTML::wizard_next(array('transaction_id' => $order->transaction_id)) }}
    </section>
</div>

{{ Form::close() }}

@stop


@section('sidebar')

@include('orders/_sidebar')

@stop
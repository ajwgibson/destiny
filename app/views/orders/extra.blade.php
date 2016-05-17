
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<div class="row">
    <section class="col-xs-10">
        <p class="lead">
            For some families the cost of Destiny Island can seem a little daunting, so this year we're
            providing vouchers to make it a little more affordable for them.
            If you feel you can contribute towards the cost of those vouchers we'd love to give you 
            the opportunity to do so. 
            Just select one of the additional contribution amounts below and we'll add it
            to your payment. 
        </p>
    </section>
</div>

{{ Form::model($order, array('route' => array('order.extra.do', $order->transaction_id))) }}

<div class="row">

    <section class="col-xs-4">

        <div class="form-group {{ $errors->has('amount_extra') ? 'has-error' : null }}">
            <p class="h5">Additional contribution</p>
            <div>
                <label class="checkbox">{{ Form::radio('amount_extra', 0) }} &nbsp;&nbsp;&nbsp;£0.00</label>
                <label class="checkbox">{{ Form::radio('amount_extra', 5) }} &nbsp;&nbsp;&nbsp;£5.00</label>
                <label class="checkbox">{{ Form::radio('amount_extra', 10) }}            &nbsp;£10.00</label>
                <label class="checkbox">{{ Form::radio('amount_extra', 15) }}            &nbsp;£15.00</label>
                <label class="checkbox">{{ Form::radio('amount_extra', 20) }}            &nbsp;£20.00</label>
            </div>
        </div>

    </section>

</div>

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
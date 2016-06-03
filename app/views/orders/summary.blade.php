
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<div class="row">
    <section class="col-xs-10">
        <p class="lead">
            Please check the contents of your order before proceeding to make a payment.
        </p>
    </section>
</div>

<div class="row">
    <section class="col-xs-8 order-summary">
        @include('orders/_summary')
    </section>
</div>


{{ Form::model($order, array('route' => array('order.summary.do', $order->transaction_id))) }}

<div class="row top-20 bottom-40">
    <section class="col-xs-10">

        {{ HTML::wizard_previous('order.permissions', array('transaction_id' => $order->transaction_id)) }}

        <div class="pull-right">
            <script
                src="https://checkout.stripe.com/checkout.js" 
                class="stripe-button"
                data-key="{{ Config::get('stripe.stripe_public_key') }}"
                data-amount="{{ $order->total_pence() }}"
                data-name="Causeway Coast Vineyard"
                data-description="Destiny Island Booking"
                data-image="{{ asset('ccv-icon.png') }}"
                data-locale="auto"
                data-zip-code="false"
                data-currency="gbp"
                data-email="{{ $order->email }}"
                data-label="Pay by card"
                data-allow-remember-me="false" >
            </script>
        </div>


    </section>
</div>

{{ Form::close() }}


@stop


@section('sidebar')


@stop
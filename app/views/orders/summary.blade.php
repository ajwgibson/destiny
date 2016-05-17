
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

        <h3><span class="glyphicon glyphicon-envelope"></span> Contact details</h3>
        <dl class="dl-horizontal">
            <dt>Name</dt>     <dd>{{{ $order->name() }}}</dd>
            <dt>Email</dt>    <dd>{{{ $order->email }}}</dd>
            <dt>Phone</dt>    <dd>{{{ $order->phone }}}</dd>
        </dl>

        <h3><span class="glyphicon glyphicon-user"> </span> Children</h3>
        @foreach ($order->children as $child)
        <dl class="dl-horizontal">
            <dt><span class="sr-only">Name</span></dt> <dd><span class="h4 name">{{{ $child->name() }}}</dd>
            <dt>Date of birth</dt>                     <dd>{{{ $child->date_of_birth->format('jS F Y') }}}</dd>
            <dt>Age on August 3rd</dt>                 <dd>{{ $child->age() }}</dd>
            <dt>T-shirt size</dt>                      <dd>{{ $child->tshirt }}</dd>
            <dt>Dancing</dt>                           <dd>{{ HTML::yes_no_icon($child->dancing) }}</dd>
            <dt>Sleepover</dt>                         <dd>{{ HTML::yes_no_icon($child->sleepover) }}</dd>
        </dl>
        @endforeach

        <h3><span class="glyphicon glyphicon-exclamation-sign"> </span> Permissions</h3>
        <dl class="dl-horizontal">
            <dt>Photographs</dt>    
            <dd>{{ HTML::yes_no_icon($order->photos_permitted) }}</dd>
            <dt>Outings</dt>
            <dd>{{ HTML::yes_no_icon($order->outings_permitted) }}</dd>
         </dl>

        <h3><span class="glyphicon glyphicon-gbp"> </span> Price</h3>
        @if ($order->cost() != $order->total())
        <dl class="dl-horizontal">
            <dt>Cost</dt>     <dd><span class="price">£{{ money_format('%(#3i', $order->cost()) }}</dd>
            @if ($order->discount() > 0)
            <dt>Discount</dt> <dd><span class="price">£{{ money_format('%(#3i', $order->discount()) }}</dd>
            @endif
            @if ($order->amount_extra > 0)
            <dt>Extra</dt>    <dd><span class="price">£{{ money_format('%(#3i', $order->amount_extra) }}</dd>
            @endif
            <dt>Total</dt>    <dd><span class="price">£{{ money_format('%(#3i', $order->total()) }}</dd>
        </dl>
        @else
        <dl class="dl-horizontal">
            <dt><span class="sr-only">Cost</span></dt>  <dd>£{{ money_format('%i', $order->total()) }}</dd>
        </dl>
        @endif
    </section>

</div>

{{ Form::model($order, array('route' => array('order.summary.do', $order->transaction_id))) }}

<div class="row top-20 bottom-40">
    <section class="col-xs-10">
        {{ HTML::wizard_previous('order.permissions', array('transaction_id' => $order->transaction_id)) }}
        {{ Form::submit('Pay now', array('class' => 'btn btn-success btn-lg pull-right')) }}
    </section>
</div>

{{ Form::close() }}


@stop


@section('sidebar')


@stop
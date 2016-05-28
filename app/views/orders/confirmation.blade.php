
@extends('layouts/frontend')

@section('content')

<div class="hidden-print">
@include('orders/_heading')
</div>

<div class="visible-print-block"><h1>Destiny Island Order Confirmation</h1></div>

<div class="row hidden-print">
    <section class="col-xs-12">
        <p class="lead">
            Thank you for your order. Please <a href="javascript:window.print();">print this page</a>
            and bring it with you on the first morning to make the registration process quicker and easier.
            We've emailed a copy of this to <i>{{{ $order->email }}}</i> for your records.
        </p>
    </section>
</div>

<div class="row">

    <section class="col-xs-12 order-summary">

        <h3><span class="glyphicon glyphicon-tag"></span> Order reference</h3>
        <dl class="dl-horizontal">
            <dt>#</dt> <dd><span class="h4 name">{{ $order->transaction_id }}</span></dd>
        </dl>

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
            <dt>Age on August 3rd</dt>                 <dd>{{ $child->age_at_start() }}</dd>
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
        <dl class="dl-horizontal">
            <dt>#</dt>  <dd>£{{ money_format('%i', $order->total()) }}</dd>
        </dl>
    </section>

</div>


@stop


@section('sidebar')


@stop
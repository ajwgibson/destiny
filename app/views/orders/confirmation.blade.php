
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
        @include('orders/_summary')
    </section>
</div>


@stop


@section('sidebar')

@stop
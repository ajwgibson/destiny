
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<p class="lead">
    Thankyou for your order. You should receive an email that will have been sent
    to the address that you provided at the start of the order process. If you don't
    receive the email, and you're sure it hasn't been intercepted by your spam
    filter, please contact us at <a href="mailto:ajw.gibson@gmail.com">this address</a>.
</p>

@stop


@section('sidebar')

@include('orders/_summary')

@stop

@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<p class="lead">
    Thanks for your order. Please print the details of your order (using the button below)
    and bring the printout to one of our registration desks on the morning of Destiny Island.
    You should also receive a confirmation email, but if you don't receive the email, and 
    you're sure it hasn't been intercepted by your spam filter, please contact us at 
    <a href="mailto:kids@causewaycoastvineyard.com">kids@causewaycoastvineyard.com</a>.
</p>

@stop


@section('sidebar')

@include('orders/_summary')

@stop
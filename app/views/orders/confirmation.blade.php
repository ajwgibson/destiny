
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<div class="row">
    <section class="col-xs-10">
        <p class="lead">
            Thank you for your order. Please print your order details (using the button below)
            and bring the printout to one of our registration desks on the morning of Destiny Island.
            You should also receive a confirmation email, but if you don't receive the email, and 
            you're sure it hasn't been intercepted by your spam filter, please contact us at 
            <a href="mailto:kids@causewaycoastvineyard.com">kids@causewaycoastvineyard.com</a>.
        </p>
    </section>
</div>

@stop


@section('sidebar')

@include('orders/_sidebar')

@stop
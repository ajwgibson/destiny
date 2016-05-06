
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<p class="lead">
    Before we continue we need you to enter the email address you provided
    with your contact details. If you can't remember what that was, or if
    you can't get back into your order, please contact us using this email address:
    <a href="mailto:kids@causewaycoastvineyard.com">kids@causewaycoastvineyard.com</a>.
</p>

{{ Form::open(array('route' => array('order.authentication.do', $transaction_id))) }}

<div class="row">

    <section class="col-xs-6">

        <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('email', 'Email', array ('class' => 'control-label')) }}
            {{ Form::text('email', null, array('aria-required'=> 'true', 'class' => 'form-control', 'maxlength' => 254)) }}
        </div>

        {{ Form::submit('Continue', array ('class' => 'btn btn-primary')) }} 

    </section>

</div>

{{ Form::close() }}

@stop


@section('sidebar')

@include('orders/_summary')

@stop
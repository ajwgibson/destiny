
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<p class="lead">
    Before we continue we need to verify the email address you provided
    with your contact details. You should have received an email with a code.
    Please enter the code below to continue with your order.
</p>

{{ Form::open(array('route' => array('order.verification.do', $transaction_id))) }}

<div class="row">

    <section class="col-xs-6">

        <div class="form-group {{ $errors->has('verification_code') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('verification_code', 'Verification code', array ('class' => 'control-label')) }}
            {{ Form::text('verification_code', null, array('aria-required'=> 'true', 'class' => 'form-control', 'maxlength' => 13)) }}
        </div>

        {{ Form::submit('Continue', array ('class' => 'btn btn-primary')) }} 

    </section>

</div>

{{ Form::close() }}

@stop


@section('sidebar')

@include('orders/_summary')

@stop

@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<p class="lead">
    Please provide all the relevant information.
</p>

{{ Form::model($child, array('route' => array('order.child.do', $order->transaction_id, $child->id))) }}

<div class="row">

    <section class="col-xs-6">

        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('first_name', 'First name', array ('class' => 'control-label')) }}
            {{ Form::text('first_name', null, array('aria-required'=> 'true', 'class' => 'form-control', 'maxlength' => 100)) }}
        </div>

        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('last_name', 'Last name', array ('class' => 'control-label')) }}
            {{ Form::text('last_name', null, array('aria-required'=> 'true', 'class' => 'form-control', 'maxlength' => 100)) }}
        </div>

        <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : '' }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label(
                    'date_of_birth', 
                    'Date of birth', 
                    array (
                        'class' => 'control-label',
                        'data-datepicker' => 'datepicker' )) }}
            <div class="input-group date dp3" 
                    data-date="{{ empty($child->date_of_birth) ? date('Y-m-d') : $child->date_of_birth->format('Y-m-d') }}" 
                    data-date-format="yyyy-mm-dd" 
                    data-date-start-view="years">
                {{ Form::text('date_of_birth', empty($child->date_of_birth) ? '' : $child->date_of_birth->format('Y-m-d') , array ('class' => 'form-control', 'readonly' => 'readonly')) }}
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>

    </section>

</div>

<div class="row top-20">
    <section class="col-xs-6">
        {{ Form::submit('Save', array ('class' => 'btn btn-primary')) }} 
    </section>
</div>

{{ Form::close() }}


@stop


@section('sidebar')

@include('orders/_summary')

@stop


@section('extra_js')

<script type="text/javascript">
    // Initialise datepicker inputs
    $('.dp3').datepicker();
</script>

@stop
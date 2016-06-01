
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<p class="lead">
    Please provide all the relevant information.
</p>

{{ Form::model($child, array('route' => array('order.child.do', $order->transaction_id, $child->id))) }}

<div class="row">

    <section class="col-xs-9">

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
            <p class="help-block">
                <span class="glyphicon glyphicon-info-sign"></span>
                The minimum age for a child is 5 years old and the maximum age is 11 years old. Children
                older than 11 can apply to be junior team members - please contact CCV for more details.
            </p>
        </div>

        <div class="form-group {{ $errors->has('school_year') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('school_year', 'School year in September', array ('class' => 'control-label')) }}
            {{ Form::select(
                    'school_year', 
                    array ( ''       => 'Select a school year...',
                            2 => 'Primary 2 (Ages 5-6)',
                            3 => 'Primary 3 (Ages 6-7)',
                            4 => 'Primary 4 (Ages 7-8)',
                            5 => 'Primary 5 (Ages 8-9)',
                            6 => 'Primary 6 (Ages 9-10)',
                            7 => 'Primary 7 (Ages 10-11)',
                            8 => 'Year 8 (Ages 11-12)'),
                    null, 
                    array ('class' => 'form-control')) }}
            <p class="help-block">
                <span class="glyphicon glyphicon-info-sign"></span>
                Please select the school year that the child will enter in September. For children
                who do not go to school in Northern Ireland, please select an appropriate value
                based on age.
            </p>
        </div>

        <div class="form-group {{ $errors->has('tshirt') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('tshirt', 'T-shirt size', array ('class' => 'control-label')) }}
            {{ Form::select(
                    'tshirt', 
                    array ( ''       => 'Select a size...',
                            'SMALL'  => 'SMALL',
                            'MEDIUM' => 'MEDIUM',
                            'LARGE'  => 'LARGE' ), 
                    null, 
                    array ('class' => 'form-control')) }}
        </div>

        <div class="form-group {{ $errors->has('dancing') ? 'has-error' : null }}">
            {{ Form::label('dancing', 'Dance activity', array ('class' => 'control-label')) }}
            <div>
                <label class="checkbox-inline">{{ Form::checkbox('dancing', true) }} Yes</label>
            </div>
            <p class="help-block">
                <span class="glyphicon glyphicon-info-sign"></span>
                This year the children will rotate around the activities in their teams unless 
                they want to take part in the dancing activity - that will run with the same children for 
                all 3 days. If your child wants to take part in the dance activity please tick this option.
            </p>
        </div>

        <div id="sleepover_section" class="form-group {{ $errors->has('sleepover') ? 'has-error' : null }} {{ $child->age_at_start() > 9 || $child->sleepover ? '' : 'hidden' }}">
            {{ Form::label('sleepover', 'Attending sleepover', array ('class' => 'control-label')) }}
            <div>
                <label class="checkbox-inline">{{ Form::checkbox('sleepover', true) }} Yes</label>
            </div>
            <p class="help-block">
                <span class="glyphicon glyphicon-info-sign"></span>
                A child has to be aged 10 or over to attend the sleepover and 
                there is an additional cost of £6.
            </p>
        </div>

        <hr>

        <div class="form-group {{ $errors->has('health_warning') ? 'has-error' : null }}">
            <span class="glyphicon glyphicon-alert control-label"></span>
            {{ Form::label('health_warning', 'Medical warning', array ('class' => 'control-label')) }}
            <div>
                <label class="checkbox-inline">{{ Form::checkbox('health_warning', true) }} Yes</label>
            </div>
            <p class="help-block">
                <span class="glyphicon glyphicon-info-sign"></span>
                If your child has a medical condition that affects the activities they can participate
                in, the food they can eat or that we should know about for any reason, please tick this
                box and provide more information in the notes section below.
            </p>
        </div>

        <hr>

        <div class="form-group {{ $errors->has('notes') ? 'has-error' : null }}">
            {{ Form::label('notes', 'Notes', array ('class' => 'control-label')) }}
            {{ Form::textarea('notes', null, array('class' => 'form-control')) }}
            <p class="help-block">
                <span class="glyphicon glyphicon-info-sign"></span>
                Please include any other information you feel we should know about this child. If you
                ticked the "Medical warning" box above then you must provide information here.
            </p>
        </div>

    </section>

</div>

<div class="row top-20">
    <section class="col-xs-6">
        {{ Form::submit('Save', array ('class' => 'btn btn-primary')) }} 
        {{ link_to_route(
            'order.children', 
            'Cancel', 
            $parameters = array('transaction_id' => $order->transaction_id), 
            $attributes = array('class' => 'btn btn-default')) }}
    </section>
</div>

{{ Form::close() }}


@stop


@section('sidebar')

@include('orders/_sidebar')

@stop


@section('extra_js')

<script type="text/javascript">
    // Initialise datepicker inputs
    $('.dp3').datepicker();

    $('input[name="date_of_birth"').change(function() {
        
        dob = new Date($(this).val());
        comparison = new Date('2016-08-03');
        age = comparison.getFullYear() - dob.getFullYear();

        if (dob.getMonth() > comparison.getMonth()
            || (dob.getMonth() == comparison.getMonth()
                && dob.getDate() > comparison.getDate())) {
            age -= 1;  
        }

        if (age < 10) {
            $('#sleepover').prop('checked', false);
            $('#sleepover').prop('disabled', true);
            $('#sleepover_section').addClass('hidden');
        } else {
            $('#sleepover').prop('disabled', false);
            $('#sleepover_section').removeClass('hidden');
        }
        
    });

</script>

@stop
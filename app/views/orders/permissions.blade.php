
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

{{ Form::model($order, array('route' => array('order.permissions.do', $order->transaction_id))) }}

<div class="row">

    <section class="col-xs-12">

        <h3>Photographs</h3>

        <p><em>
            Photographs may be taken during Destiny Island activities and used in material connected to the church; 
            this may include the church website, Facebook pages, local press or church notice boards.
        </em></p>

        <div class="form-group {{ $errors->has('photos_permitted') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label(
                'photos_permitted', 
                'I give permission for the children included with this order to be photographed', 
                array ('class' => 'control-label')) }}
            <div>
                <label class="checkbox-inline">{{ Form::radio('photos_permitted', 1) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('photos_permitted', 0) }} No</label>
            </div>
        </div>

    </section>

</div>

<div class="row">

    <section class="col-xs-12">

        <h3>Outings</h3>

        <p><em>
            Some of the Destiny Island activities involve leaving the church building. Adults will
            accompany children at all times.
        </em></p>

        <div class="form-group {{ $errors->has('outings_permitted') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label(
                'outings_permitted', 
                'I give permission for the children included with this order to leave the church building during activities', 
                array ('class' => 'control-label')) }}
            <div>
                <label class="checkbox-inline">{{ Form::radio('outings_permitted', 1) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('outings_permitted', 0) }} No</label>
            </div>
        </div>

    </section>

</div>

<div class="row top-20">
    <section class="col-xs-12">
        {{ HTML::wizard_previous('order.contact_details', array('transaction_id' => $order->transaction_id)) }}
        {{ HTML::wizard_next(array('transaction_id' => $order->transaction_id)) }}
    </section>
</div>

{{ Form::close() }}

@stop


@section('sidebar')

@include('orders/_summary')

@stop
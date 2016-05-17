
@extends('layouts/frontend')

@section('content')

@include('orders/_heading')

<div class="row">
    <section class="col-xs-10">
        <p class="lead">
            There are a small number of things that require your consent. Please read and respond
            to the following carefully.
        </p>
    </section>
</div>

{{ Form::model($order, array('route' => array('order.permissions.do', $order->transaction_id))) }}

<div class="row">

    <section class="col-xs-10">

        <h3>Photographs</h3>

        <p><em>
            Photographs may be taken during Destiny Island activities and used in material connected to the church; 
            this may include the church website, Facebook pages, local press or church notice boards.
        </em></p>

        <div class="form-group {{ $errors->has('photos_permitted') ? 'has-error' : null }}">
            
            <label for="outings_permitted" class="control-label">{{{ Destiny\ViewHelper::required_icon() }}} 
                I give permission for these children to be photographed</label>

            <div>
                <label class="checkbox-inline">{{ Form::radio('photos_permitted', 1) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('photos_permitted', 0) }} No</label>
            </div>
        </div>

    </section>

</div>

<div class="row">

    <section class="col-xs-10">

        <h3>Outings</h3>

        <p><em>
            Some of the Destiny Island activities involve leaving the church building. Adults will
            accompany children at all times.
        </em></p>

        <div class="form-group {{ $errors->has('outings_permitted') ? 'has-error' : null }}">
            
            <label for="outings_permitted" class="control-label">{{{ Destiny\ViewHelper::required_icon() }}} 
                I give permission for these children to leave the church building during supervised activities</label>
            
            <div>
                <label class="checkbox-inline">{{ Form::radio('outings_permitted', 1) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('outings_permitted', 0) }} No</label>
            </div>
        </div>

    </section>

</div>

<div class="row top-20 bottom-40">
    <section class="col-xs-10">
        {{ HTML::wizard_previous('order.children', array('transaction_id' => $order->transaction_id)) }}
        {{ HTML::wizard_next(array('transaction_id' => $order->transaction_id)) }}
    </section>
</div>

{{ Form::close() }}

@stop


@section('sidebar')

@include('orders/_sidebar')

@stop

<div class="row">
    <div class="col-md-8" id="inner-content">
        
        {{ Form::model($order, array('route' => array('admin.order.contact_details.do', $order->transaction_id))) }}

        <div class="row">

            <section class="col-xs-10">

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

                <div class="form-group {{ $errors->has('phone') ? 'has-error' : null }}">
                    {{{ Destiny\ViewHelper::required_icon() }}}
                    {{ Form::label('phone', 'Phone number', array ('class' => 'control-label')) }}
                    {{ Form::text('phone', null, array('aria-required'=> 'true', 'class' => 'form-control', 'maxlength' => 50)) }}
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
                    {{ Form::label('email', 'Email address', array ('class' => 'control-label')) }}
                    {{ Form::email('email', null, array('aria-required'=> 'true', 'class' => 'form-control', 'maxlength' => 254)) }}
                </div>

            </section>

        </div>

        <div class="row top-20 bottom-40">
            <section class="col-xs-10">
                {{ HTML::wizard_next(array('transaction_id' => $order->transaction_id)) }}
            </section>
        </div>

        {{ Form::close() }}

    </div>

    <div class="col-md-4 hidden-print" id="sidebar">
        @include('orders/_sidebar')
    </div>

</div>

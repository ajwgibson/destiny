
<div class="row">
    <section class="col-xs-12">
        <p class="lead">
            You can create one or more voucher by setting the discount amount and a
            limit on the number of children the discount can be applied to. 
            Each voucher will be created with a unique code.
        </p>
    </section>
</div>

{{ Form::model($voucher, array('route' => 'admin.voucher.store')) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="row">

    <section class="col-xs-12">

        <div class="form-group {{ $errors->has('batch_size') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('batch_size', 'Batch size', array ('class' => 'control-label')) }}
            <div class="row">
                <div class="col-xs-2">
                    {{ Form::number('batch_size', null, array('aria-required'=> 'true', 'class' => 'form-control', 'min' => '1', 'max' => '50')) }}
                </div>
            </div>
        </div>
        <p class="help-block">The number of vouchers that will be created in this batch (maximum of 50).</p>

        <div class="form-group {{ $errors->has('discount') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('discount', 'Discount', array ('class' => 'control-label')) }}
            <div class="row">
                <div class="col-xs-2">
                    {{ Form::number('discount', null, array('aria-required'=> 'true', 'class' => 'form-control', 'min' => '0', 'max' => '100')) }}
                </div>
            </div>
        </div>
        <p class="help-block">The discount as a percentage between 0% and 100%.</p>


        <div class="form-group {{ $errors->has('child_limit') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('child_limit', 'Child limit', array ('class' => 'control-label')) }}
            <div class="row">
                <div class="col-xs-2">
                    {{ Form::number('child_limit', null, array('aria-required'=> 'true', 'class' => 'form-control', 'min' => '1', 'max' => '10')) }}
                </div>
            </div>
        </div>
        <p class="help-block">The maximum number of children the discount can be applied to on the order.</p>
        
        {{ Form::submit('Create voucher(s)', array('class' => 'btn btn-primary')) }}

    </section>

</div>

{{ Form::close() }}
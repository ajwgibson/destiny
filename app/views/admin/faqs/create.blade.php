
<div class="row">
    <section class="col-xs-12">
        <p class="lead">
            When you add an FAQ it will be placed at the end of the list
            by default, but you can reorder questions later.
        </p>
    </section>
</div>

{{ Form::model($faq, array('route' => 'admin.faq.store')) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="row">

    <section class="col-xs-12">

        <div class="form-group {{ $errors->has('question') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('question', 'Question', array ('class' => 'control-label')) }}
            {{ Form::textarea('question', null, array('class' => 'form-control', 'size' => '50x2')) }}
            <p class="help-block">
                Please try to keep the question as short and succinct as possible.
            </p>
        </div>

        <div class="form-group {{ $errors->has('answer') ? 'has-error' : null }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('answer', 'Answer', array ('class' => 'control-label')) }}
            {{ Form::textarea('answer', null, array('class' => 'form-control')) }}
        </div>
        
        {{ Form::submit('Create FAQ', array('class' => 'btn btn-primary')) }}

    </section>

</div>

{{ Form::close() }}
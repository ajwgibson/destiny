
{{ Form::model($faq, array('method' => 'put', 'route' => array('admin.faq.update', $faq->id))) }}

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
        
        {{ Form::submit('Update FAQ', array('class' => 'btn btn-primary')) }}

    </section>

</div>

{{ Form::close() }}
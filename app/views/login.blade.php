
{{ Form::open(array('route' => 'do.login')) }}

<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('username', 'Username', array ('class' => 'control-label')) }}
            {{ Form::text('username', '', array ('class' => 'form-control')) }}
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('password', 'Password', array ('class' => 'control-label')) }}
            {{ Form::password('password', array ('class' => 'form-control')) }}
        </div>
        {{ Form::submit('Login', array ('class' => 'btn btn-primary')) }} 
    </div>
</div>

{{ Form::close() }}

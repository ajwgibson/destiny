
{{ Form::model($user, array('route' => array('admin.user.updatePassword', $user->id))) }}

<div class="row">
    <div class="col-md-4">

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('password', 'New password', array ('class' => 'control-label')) }}
            {{ Form::password('password', array ('class' => 'form-control')) }}
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            {{{ Destiny\ViewHelper::required_icon() }}}
            {{ Form::label('password_confirmation', 'Confirm new password', array ('class' => 'control-label')) }}
            {{ Form::password('password_confirmation', array ('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Change password', array ('class' => 'btn btn-primary')) }} 

        {{ link_to_route(
            'admin.user.index', 
            'Go back', 
            $parameters = array( 'id' => $user->id ), 
            $attributes = array( 'class' => 'btn btn-default')) }}
            
    </div>
</div>

{{ Form::close() }}

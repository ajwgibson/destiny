
{{ Form::model($registration, array('method' => 'put', 'route' => array('admin.registration.update', $registration->id))) }}


<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
    {{ Form::label('contact_name', 'Contact name', array ('class' => 'control-label required')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('contact_name', $registration->contact_name, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
    {{ Form::label('contact_number', 'Contact number', array ('class' => 'control-label required')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::text('contact_number', $registration->contact_number, array ('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
    {{ Form::label('notes', 'Notes', array ('class' => 'control-label')) }}
    <div class="row">
        <div class="col-sm-6">
            {{ Form::textarea('notes', $registration->notes, array ('class' => 'form-control')) }}
        </div>
    </div>
    <p class="help-block">Notes for this day only i.e. don't repeat notes already recorded on the booking for the entire week.</p>
</div>

<div class="form-group">
    {{ Form::submit('Update this registration', array ('class' => 'btn btn-primary')) }} 
</div>

{{ Form::close() }}

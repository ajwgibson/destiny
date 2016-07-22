
<div class="row">

    <div class="col-sm-12">

        <p>Enter a child's first or last name (as recorded on the order) to search:</p>

        {{ Form::open(array('route' => 'registration.search')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name', array ('class' => 'control-label')) }}
            <div class="row">
                <div class="col-xs-6">
                    {{ Form::text('name', Input::get('name'), array ('class' => 'form-control')) }}
                </div>
            </div>
            <p class="help-block">
                <em><strong>Hint:</strong> Try the child's first or last name, but not both.
                    If you're not sure of the correct spelling try part of the name.</em>
            </p>
        </div>

        {{ Form::submit('Search', array ('class' => 'btn btn-success')) }} 

        {{ Form::close() }}

        @if (isset($children))

            <p style="margin-top: 20px;">The following children have matched the search criteria. Pick one to continue or search again.</p>

            @foreach ($children as $child)
            
            <div class="panel panel-primary panel-search-result">

                <div class="panel-heading">
                    <h3 class="panel-title text-uppercase">{{{ $child->name() }}}</h3>
                </div>
                
                <div class="panel-body">

                    <div class="row">

                        <div class="col-sm-4">
                            <dl>
                                <dt>Date of birth</dt>
                                <dd>{{{ $child->date_of_birth->format('jS F Y') }}}</dd>
                                <dt>Age</dt>
                                <dd>{{{ $child->age() }}}</dd>
                                <dt>School year (in September)</dt>
                                <dd>{{{ $child->school_year }}}</dd>
                                <dt>Dance activity</dt>
                                <dd>{{ HTML::yes_no_icon($child->dancing) }}</dd>
                                <dt>Destiny HighLand</dt>
                                <dd>{{ HTML::yes_no_icon($child->sleepover) }}</dd>
                            </dl>
                        </div>

                        <div class="col-sm-8">

                            <?php $todays_registration = $child->todays_registration(); ?>

                            @if ($todays_registration)

                            <p>{{{ $child->name() }}} has already been registered today with the following details:</p>

                            <dl>
                                <dt>Registration time</dt>
                                <dd>{{{ $todays_registration->created_at->format('g:sa') }}}</dd>
                                <dt>Contact name</dt>
                                <dd>{{{ $todays_registration->contact_name }}}</dd>
                                <dt>Contact number</dt>
                                <dd>{{{ $todays_registration->contact_number }}}</dd>
                                <dt>Notes</dt>
                                <dd>{{ nl2br($todays_registration->notes) }}</dd>
                            </dl>

                            @if (Auth::user()->admin)
                            <p>
                                If you think that is an error, please use 

                                {{ link_to_route(
                                    'admin.registration.show', 
                                    'this link', 
                                    $parameters = array( 'id' => $todays_registration->id), 
                                    $attributes = array( 'class' => '')) }}

                                to view the registration record and amend or remove it.
                            </p>
                            @else
                            <p>
                                If you think that is an error, please ask an administrator
                                to amend or remove the registration as appropriate.
                            </p>
                            @endif

                            @else

                            {{ Form::open(array('route' => 'registration.register', 'class' => '')) }}
                            {{ Form::hidden('child_id', $child->id) }}

                            <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                                {{{ Destiny\ViewHelper::required_icon() }}}
                                {{ Form::label('contact_name', 'Contact name', array ('class' => 'control-label')) }}
                                {{ Form::text('contact_name', $child->contact_name, array ('class' => 'form-control')) }}
                            </div>

                            <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                {{{ Destiny\ViewHelper::required_icon() }}}
                                {{ Form::label('contact_number', 'Contact number', array ('class' => 'control-label')) }}
                                {{ Form::text('contact_number', $child->contact_number, array ('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('notes', 'Notes', array ('class' => 'control-label')) }}
                                {{ Form::textarea('notes', $child->notes, array ('class' => 'form-control', 'size' => '20x3' )) }}
                            </div>

                            <p class="help-block">
                                Please confirm the details above are correct and relevent for today and 
                                amend if necessary before clicking the "Register" button.
                            </p>

                            <div class="form-group">
                                <label class="checkbox-inline">{{ Form::checkbox('print_label', true, $child->has_never_registered()) }} Print label</label><br/>
                            </div>
                            
                            <div class="form-group">
                                {{ Form::submit('Register', array ('class' => 'btn btn-primary')) }} 
                            </div>

                            {{ Form::close() }}

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        @endif

    </div>

</div>

    
@section('sidebar')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Registration counters</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">Expected <span class="badge alert-info">{{{ $expected }}}</span></li>
            <li class="list-group-item">Wednesday <span class="badge alert-info">{{{ $wednesday }}}</span></li>
            <li class="list-group-item">Thursday <span class="badge alert-info">{{{ $thursday }}}</span></li>
            <li class="list-group-item">Friday <span class="badge alert-info">{{{ $friday }}}</span></li>
        </ul>
    </div>
</div>

@stop
    
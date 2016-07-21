
<div class="pull-right">
    <a class="btn" data-toggle="collapse" data-target="#filter">
        @if ($filtered)
        <span class="glyphicon glyphicon-warning-sign"></span>
        @endif
        Filter registrations
        <span class="caret"></span>
    </a>
</div>

<div class="clearfix"></div>

<div id="filter" class="filter collapse">

    <div class="col-sm-6"></div>

    {{ Form::open(array('route' => array('admin.registration.filter'))) }}

    <div class="col-sm-6 panel panel-default">

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_day', 'Registration day', array('class' => 'control-label')) }}
                <div>
                    {{ Form::select('filter_day', $days, $filter_day, array ('class' => 'form-control')) }}
                </div>
            </div>

        </div>

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_name', 'Child\'s name', array ('class' => 'control-label')) }}
                <div>
                    {{ Form::text('filter_name', $filter_name, array ('class' => 'form-control')) }}
                </div>
                <p class="help-block">You can enter a full or partial first or last name, but not both</p>
            </div>

        </div>

        <div class="col-sm-6 col-sm-offset-6">
            {{ Form::submit('Apply filters', array('class' => 'btn btn-info')) }}

            {{ link_to_route(
                'admin.registration.resetfilter', 
                'Reset filters', 
                $parameters = array( ), 
                $attributes = array( 'class' => 'btn btn-default' ) ) }}

        </div>

    </div>

    {{ Form::close() }}

</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Group</th>
            <th>Date &amp; time</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($registrations as $registration)
        <tr>
            <td>{{{ $registration->child->name() }}}</td>
            <td>{{{ $registration->contact_name }}} ({{{ $registration->contact_number }}})</td>
            <td>{{{ $registration->child->team_name() }}}</td>
            <td>{{{ Destiny\ViewHelper::london_time($registration->created_at) }}}</td>
            <td>{{ link_to_route(
                    'admin.registration.show', 
                    'Show details', 
                    $parameters = array( 'id' => $registration->id), 
                    $attributes = array( 'class' => '')) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pull-right">
    {{ $registrations->links() }}
</div>
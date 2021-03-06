
<h2 class="visible-print">{{{ Child::get_team_name($team) }}}, {{{ $day }}}</h2>

<div class="top-20 bottom-20 hidden-print">

    {{ Form::open(array('route' => 'doTeamPrintout', 'class' => 'form-inline')) }}

    <div class="form-group">
        {{ Form::label('day', 'Day', array ('class' => '')) }}
        {{ Form::select(
                'day', 
                array(
                    'Monday' => 'Monday', 
                    'Tuesday' => 'Tuesday',
                    'Wednesday' => 'Wednesday',
                    'Thursday' => 'Thursday',
                    'Friday' => 'Friday',
                    ), 
                $day, 
                array ('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('team', 'Team', array ('class' => '')) }}
        {{ Form::select('team', $teams, $team, array ('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Apply filters', array('class' => 'btn btn-default form-control')) }}

    {{ Form::close() }}
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>School year<br/>&amp; age</th>
            <th>Contact details</th>
            <th>Photos</th>
            <th>Outings</th>
            <th>Activities</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($registrations as $registration)
        <tr>
            <td>{{{ $registration->child->name() }}}</td>
            <td>{{{ $registration->child->short_school_year() }}} ({{{ $registration->child->age() }}})</td>
            <td>{{{ $registration->contact_details() }}}</td>
            <td>{{ HTML::yes_no_icon($registration->child->order->photos_permitted) }}</td>
            <td>{{ HTML::yes_no_icon($registration->child->order->outings_permitted) }}</td>
            <td>{{{ $registration->child->activities() }}}</td>
            <td>{{{ $registration->notes }}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<a href="javascript:window.print();" class="btn btn-primary pull-right hidden-print">
    <i class="glyphicon glyphicon-print"></i>&nbsp;Print
</a>
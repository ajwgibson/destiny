{{ Form::model($child, array('route' => array('admin.child.team.do', $child->id))) }}

<div class="row">
    <section class="col-xs-9">
        <div class="form-group">
            {{ Form::label('team', 'Team', array ('class' => 'control-label')) }}
            {{ Form::select(
                    'team', 
                    $teams,
                    $child->team, 
                    array ('class' => 'form-control')) }}
        </div>
    </section>
</div>

<div class="row top-20 bottom-20">
    <section class="col-xs-6">
        {{ Form::submit('Update team', array('class' => 'btn btn-primary')) }}

        {{ link_to_route(
                'admin.child.show', 
                'Cancel', 
                $parameters = array('id' => $child->id), 
                $attributes = array('class' => 'btn btn-default')) }}
    </section>
</div>

{{ Form::close() }}


@section('extra_js')

@stop
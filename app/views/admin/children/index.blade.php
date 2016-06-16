
<div class="pull-right">
    <a class="btn" data-toggle="collapse" data-target="#filter">
        @if ($filtered)
        <span class="glyphicon glyphicon-warning-sign"></span>
        @endif
        Filter children
        <span class="caret"></span>
    </a>
</div>


<div class="clearfix"></div>


<div id="filter" class="filter collapse">

    {{ Form::open(array('route' => array('admin.child.filter'))) }}

    <div class="col-sm-8 col-sm-offset-4 panel panel-default">

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_name', 'Name', array ('class' => 'control-label')) }}
                <div>
                    {{ Form::text('filter_name', $filter_name, array ('class' => 'form-control')) }}
                </div>
                <p class="help-block">Can be part of a first name or a last name, but not both.</p>
            </div>

        </div>

        <div class="col-sm-6">
        </div>

        <div class="col-sm-6 col-sm-offset-6">
            <div class="pull-right">
            {{ Form::submit('Apply filters', array('class' => 'btn btn-info')) }}

            {{ link_to_route(
                'admin.child.filter.reset', 
                'Reset filters', 
                $parameters = array( ), 
                $attributes = array( 'class' => 'btn btn-default' ) ) }}
            </div>
        </div>

    </div>

    {{ Form::close() }}

</div>



<div class="row">
    <div class="col-sm-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>School year &amp; age (on August 3rd)</th>
                    <th>Destiny HighLand</th>
                    <th>Activities</th>
                    <th>Health warning</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($children as $child)
                <tr>
                    <td>{{{ $child->first_name }}}</code></td>
                    <td>{{{ $child->last_name }}}</code></td>
                    <td>{{{ $child->school_year() }}}<br>({{{ $child->age_at_start() }}})</td>
                    <td>{{ HTML::yes_no_icon($child->sleepover) }}</td>
                    <td>
                        @if ($child->dancing)
                        Dancing
                        @else
                        {{{ $child->activity_choice_1 }}}<br>
                        {{{ $child->activity_choice_2 }}}<br>
                        {{{ $child->activity_choice_3 }}}
                        @endif
                    </td>
                    <td>
                        @if ($child->health_warning)
                        <span class="text-danger"><span class="glyphicon glyphicon-alert"></span> </span>
                        @endif
                    </td>
                    <td>
                        {{ link_to_route(
                            'admin.order.show', 
                            $child->order->name(), 
                            $parameters = array( 'id' => $child->order->id), 
                            $attributes = array( 'class' => '')) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="pull-right">
    {{ $children->links() }}
</div>

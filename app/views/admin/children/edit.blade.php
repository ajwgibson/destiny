
{{ Form::model($child, array('route' => array('admin.child.update', $child->id))) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

@include('admin/orders/_child')

<div class="row top-20 bottom-20">
    <section class="col-xs-6">
        {{ Form::submit('Update child', array('class' => 'btn btn-primary')) }}

        {{ link_to_route(
                'admin.child.show', 
                'Cancel', 
                $parameters = array('id' => $child->id), 
                $attributes = array('class' => 'btn btn-default')) }}
    </section>
</div>

{{ Form::close() }}


@section('extra_js')

@include('admin/orders/_child_js')

@stop
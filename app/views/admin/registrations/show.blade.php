
<div class="col-sm-6">
    <dl class="dl-horizontal">
        
        <dt>Registration date</dt>
        <dd>{{{ Destiny\ViewHelper::london_time($registration->created_at) }}}</dd>

        <dt>Contact name</dt>
        <dd>{{{ $registration->contact_name }}}</dd>

        <dt>Contact number</dt>
        <dd>{{{ $registration->contact_number }}}</dd>

        <dt>Photos permitted</dt>
        <dd>{{ HTML::yes_no_icon($registration->child->order->photos_permitted) }}</dd>

        <dt>Outings permitted</dt>
        <dd>{{ HTML::yes_no_icon($registration->child->order->outings_permitted) }}</dd>

        <dt>Notes</dt>
        <dd>{{ nl2br($registration->notes) }}</dd>

    </dl>
</div>

<div class="col-sm-6 hidden-print">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('admin.registration.destroy', $registration->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'admin.registration.edit', 
            'Edit this registration', 
            $parameters = array( 'id' => $registration->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this registration', 
            array(
                'class' => 'btn btn-danger',
                'data-toggle' => 'modal',
                'data-target' => '#modal' )) }}
    </div>

    {{ Form::close() }}

</div>

<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-danger" style="font-size: 2em;">
            <span class="glyphicon glyphicon-warning-sign"></span> Warning
        </p>
        <p>
            You are about to delete this registration, are you sure you want to continue?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No, cancel</button>
        <button type="button" id="continue" class="btn btn-danger">Yes, continue</button>
      </div>
    </div>
  </div>
</div>


@section('extra_js')

<script type="text/javascript">
    
    $('#continue').click(function() {
        $('form.delete').submit();
    });
    
</script>

@endsection
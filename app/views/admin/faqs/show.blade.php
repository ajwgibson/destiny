
<div class="col-sm-8 show_panel">

    <h3><span class="glyphicon glyphicon-info-sign"></span> FAQ details</h3>
    <dl class="dl">
        <dt>Position</dt>             
        <dd>{{{ $faq->position }}}</dd>

        <dt>Question</dt>         
        <dd>{{ nl2br($faq->question) }}</dd>

        <dt>Answer</dt> 
        <dd>{{ nl2br($faq->answer) }}</dd>
    </dl>
        
</div>

<div class="col-sm-4 edit_delete_panel">

    <h4>Actions</h4>

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('admin.faq.destroy', $faq->id),
            'class' => 'delete' ) ) }}

    <div class="action">
        {{ link_to_route(
            'admin.faq.edit', 
            'Edit FAQ', 
            $parameters = array( 'id' => $faq->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div class="action">
        {{ Form::button(
            'Delete this FAQ', 
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
                    You are about to delete this FAQ. Are you sure you want to continue?
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

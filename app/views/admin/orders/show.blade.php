<div class="col-xs-8 order-summary">
    @include('orders/_summary')
</div>

<div class="col-sm-4 edit_delete_panel">

    <h4>Actions</h4>

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('admin.order.destroy', $order->id),
            'class' => 'delete' ) ) }}

    @if ($order->status == Order::StatusCash)
    <div class="action">
        {{ link_to_route(
                'admin.order.contact_details', 
                'Edit details', 
                $parameters = array( $order->transaction_id), 
                $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>
    @endif

    <div class="action">
        {{ Form::button(
            'Delete this order', 
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
                    You are about to delete this order. Are you sure you want to continue?
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

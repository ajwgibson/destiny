
<div class="col-sm-8 show_panel">

    <h3><span class="glyphicon glyphicon-info-sign"></span> Voucher details</h3>
    <dl class="dl-horizontal">
        <dt>Code</dt>             
        <dd>{{{ $voucher->code }}}</dd>

        <dt>Discount</dt>         
        <dd>{{{ $voucher->discount }}}%</dd>

        <dt>Limit (children)</dt> 
        <dd>{{{ $voucher->child_limit }}}</dd>

        <dt>Order</dt>
        <dd>
            @if ($voucher->order)
                {{ link_to_route(
                    'admin.order.show', 
                    $voucher->order->name(), 
                    $parameters = array( 'id' => $voucher->order->id), 
                    $attributes = array( 'class' => '')) }}
            @else
                <i>Not used yet</i>
            @endif
        </dd>
    </dl>
        
</div>

<div class="col-sm-4 edit_delete_panel">

    <h4>Actions</h4>

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('admin.voucher.destroy', $voucher->id),
            'class' => 'delete' ) ) }}

    <div class="action">
        {{ link_to_route(
            'admin.voucher.edit', 
            'Edit voucher', 
            $parameters = array( 'id' => $voucher->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div class="action">
        {{ Form::button(
            'Delete this voucher', 
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
                    You are about to delete this voucher. Are you sure you want to continue?
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

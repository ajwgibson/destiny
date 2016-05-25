
<div class="col-sm-8 order-summary">

    <h3><span class="glyphicon glyphicon-envelope"></span> Contact details</h3>
    <dl class="dl-horizontal">
        <dt>Name</dt>     <dd>{{{ $order->name() }}}</dd>
        <dt>Email</dt>    <dd>{{{ $order->email }}}</dd>
        <dt>Phone</dt>    <dd>{{{ $order->phone }}}</dd>
    </dl>

    <h3><span class="glyphicon glyphicon-user"> </span> Children</h3>
    @foreach ($order->children as $child)
    <dl class="dl-horizontal">
        <dt><span class="sr-only">Name</span></dt> <dd><span class="h4 name">{{{ $child->name() }}}</dd>
        <dt>Date of birth</dt>                     <dd>{{{ $child->date_of_birth->format('jS F Y') }}}</dd>
        <dt>Age on August 3rd</dt>                 <dd>{{ $child->age() }}</dd>
        <dt>T-shirt size</dt>                      <dd>{{ $child->tshirt }}</dd>
        <dt>Dancing</dt>                           <dd>{{ HTML::yes_no_icon($child->dancing) }}</dd>
        <dt>Sleepover</dt>                         <dd>{{ HTML::yes_no_icon($child->sleepover) }}</dd>
    </dl>
    @endforeach

    <h3><span class="glyphicon glyphicon-exclamation-sign"> </span> Permissions</h3>
    <dl class="dl-horizontal">
        <dt>Photographs</dt>    
        <dd>{{ HTML::yes_no_icon($order->photos_permitted) }}</dd>
        <dt>Outings</dt>
        <dd>{{ HTML::yes_no_icon($order->outings_permitted) }}</dd>
     </dl>

    <h3><span class="glyphicon glyphicon-gbp"> </span> Price</h3>
    @if ($order->cost() != $order->total())
    <dl class="dl-horizontal">
        <dt>Cost</dt>     <dd><span class="price">£{{ money_format('%(#3i', $order->cost()) }}</dd>
        @if ($order->discount() > 0)
        <dt>Discount</dt> <dd><span class="price">£{{ money_format('%(#3i', $order->discount()) }}</dd>
        @endif
        @if ($order->amount_extra > 0)
        <dt>Extra</dt>    <dd><span class="price">£{{ money_format('%(#3i', $order->amount_extra) }}</dd>
        @endif
        <dt>Total</dt>    <dd><span class="price">£{{ money_format('%(#3i', $order->total()) }}</dd>
    </dl>
    @else
    <dl class="dl-horizontal">
        <dt><span class="sr-only">Cost</span></dt>  <dd>£{{ money_format('%i', $order->total()) }}</dd>
    </dl>
    @endif
        
</div>

<div class="col-sm-4 edit_delete_panel">

    <h4>Actions</h4>

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('admin.order.destroy', $order->id),
            'class' => 'delete' ) ) }}

    <div class="action">
        {{ link_to_route(
            'admin.order.index', 
            'Go back',
            $parameters = array(),
            $attributes = array( 'class' => 'btn btn-default' )) }}
    </div>

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

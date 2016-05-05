
<section>
    <h3>Order summary</h3>

    <div class="media">
        <div class="media-left">
            <div class="media-object"><span class="glyphicon glyphicon-envelope"> </span></div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Contact details</h4>
            @if (isset($order->first_name))
            {{{ $order->first_name . ' ' . $order->last_name }}}<br>
            {{{ $order->email }}}<br>
            {{{ $order->phone }}}
            @else
            <i>Not captured yet</i>
            @endif
        </div>
    </div>

    <div class="media">
        <div class="media-left">
            <div class="media-object"><span class="glyphicon glyphicon-user"> </span></div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Children</h4>
            <i>Not captured yet</i>
        </div>
    </div>

    <div class="media">
        <div class="media-left">
            <div class="media-object"><span class="glyphicon glyphicon-exclamation-sign"> </span></div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Permissions</h4>
            @if (isset($order->photos_permitted))
            Photographs: 
                {{ $order->photos_permitted ?
                        '<span class="text-success"><span class="glyphicon glyphicon-ok"> </span></span>' 
                        : '<span class="text-danger"><span class="glyphicon glyphicon-remove"> </span></span>' }}
                <br>
            Outings: 
                {{ $order->outings_permitted ?
                        '<span class="text-success"><span class="glyphicon glyphicon-ok"> </span></span>' 
                        : '<span class="text-danger"><span class="glyphicon glyphicon-remove"> </span></span>' }}
            @else
            <i>Not captured yet</i>
            @endif
        </div>
    </div>

    <div class="media">
        <div class="media-left">
            <div class="media-object"><span class="glyphicon glyphicon-gbp"> </span></div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Price</h4>
            <i>Not calculated yet</i>
        </div>
    </div>

</section>
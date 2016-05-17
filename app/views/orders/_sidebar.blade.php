
<section class="order-summary">
    <h3>Order summary</h3>

    <div class="media">
        <div class="media-left">
            <div class="media-object"><span class="glyphicon glyphicon-envelope"> </span></div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Contact details</h4>
            @if (isset($order))
                @if (isset($order->first_name))
                {{{ $order->first_name . ' ' . $order->last_name }}}<br>
                {{{ $order->email }}}<br>
                {{{ $order->phone }}}
                @else
                <i>Not captured yet</i>
                @endif
            @else
                <i>Pending email verification</i>
            @endif
        </div>
    </div>

    <div class="media">
        <div class="media-left">
            <div class="media-object"><span class="glyphicon glyphicon-user"> </span></div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Children</h4>
            @if (isset($order) && $order->children->count() > 0)
            <ul class="list-unstyled">
                @foreach ($order->children as $child)
                <li>{{{ $child->first_name . ' ' . $child->last_name }}}</li>
                @endforeach
            </ul>
            @else
            <i>Not captured yet</i>
            @endif
        </div>
    </div>

    <div class="media">
        <div class="media-left">
            <div class="media-object"><span class="glyphicon glyphicon-exclamation-sign"> </span></div>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Permissions</h4>
            @if (isset($order->photos_permitted))
            Photographs: {{ HTML::yes_no_icon($order->photos_permitted) }} <br>
            Outings:     {{ HTML::yes_no_icon($order->outings_permitted) }}
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
            @if (isset($order) && $order->children->count() > 0)
                @if ($order->cost() != $order->total())
                <table class="pricing">
                    <tr><td>Cost</td>     <td>£{{ money_format('%(#3i', $order->cost()) }}</td></tr>
                    @if ($order->discount() > 0)
                    <tr><td>Discount</td> <td>£{{ money_format('%(#3i', $order->discount()) }}</td></tr>
                    @endif
                    @if ($order->amount_extra > 0)
                    <tr><td>Extra</td> <td>£{{ money_format('%(#3i', $order->amount_extra) }}</td></tr>
                    @endif
                    <tr><td>Total</td>    <td>£{{ money_format('%(#3i', $order->total()) }}</td></tr>
                </table>
                @else
                    £{{ money_format('%i', $order->total()) }}
                @endif
            @else
                <i>Not calculated yet</i>
            @endif
        </div>
    </div>

</section>
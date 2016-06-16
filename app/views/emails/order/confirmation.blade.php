
<body style="font-family: sans-serif;">

    <p>
        Thank you for your order. Please print the

        {{ link_to_route(
                'order.confirmation', 
                'confirmation page', 
                $parameters = array( 'transaction_id' => $order->transaction_id ), 
                $attributes = array( 'class' => 'btn btn-primary', 'target' => '_blank' ) ) }}

        for your order and bring it with you on the first morning to make the registration 
        process quicker and easier.
    </p>

    <p>Here are the full details of your order:</p>

    <table border="0" cellspacing="3" cellpadding="2" style="margin-left: 20px;">

        <tr><td colspan="3"></td></tr>

        <tr valign="top">
            <td nowrap><b><small>Order reference</small></b></td>
            <td colspan="2">{{ $order->transaction_id }}</td>
        </tr>

        <tr><td colspan="3"></td></tr>

        <tr valign="top">
            <td nowrap><b><small>Contact details</small></b></td>
            <td colspan="2">
                {{{ $order->name() }}}<br/>
                {{{ $order->email }}}<br/>
                {{{ $order->phone }}}
            </td>
        </tr>

        <tr><td colspan="3"></td></tr>

        <tr valign="top">
            <td nowrap><b><small>Children</small></b></td>
            <td colspan="2">({{ $order->children->count() }})</td>
        </tr>
        @foreach ($order->children as $child)
        <tr>
            <td></td>
            <td colspan="2"><b>{{ $child->name() }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><small>Date of birth</small></td>      
            <td>{{ $child->date_of_birth->format('jS F Y') }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><small>Age on August 3rd</small></td>  
            <td>{{ $child->age_at_start() }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><small>School year in September</small></td>  
            <td>{{ $child->school_year() }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><small>T-shirt size</small></td>       
            <td>{{ $child->tshirt }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><small>Dancing</small></td>            
            <td>{{ $child->dancing ? 'Yes' : 'No' }}</td>
        </tr>
@if (!($child->dancing))
        <tr>
            <td></td>
            <td align="right"><small>Activity preferences</small></td>
            <td>
                {{ $child->activity_choice_1 }}<br>
                {{ $child->activity_choice_2 }}<br>
                {{ $child->activity_choice_3 }}
            </td>  
        </tr>
@endif
        <tr>
            <td></td>
            <td align="right"><small>Destiny HighLand</small></td>          
            <td>{{ $child->sleepover ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><small>Medical warning</small></td>          
            <td>{{ $child->health_warning ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="right"><small>Notes</small></td>          
            <td>{{ nl2br($child->notes) }}</td>
        </tr>
        @endforeach

        <tr><td colspan="3"></td></tr>

        <tr valign="top">
            <td nowrap><b><small>Permissions</small></b></td>
            <td colspan="2">
                Photographs: {{ $order->photos_permitted ? 'Yes' : 'No' }}<br/>
                Outings: {{ $order->outings_permitted ? 'Yes' : 'No' }}
            </td>
        </tr>

        <tr><td colspan="3"></td></tr>

        <tr valign="top">
            <td nowrap><b><small>Price</small></b></td>
            <td colspan="2">
            @if ($order->cost() != $order->total())
                Cost: &pound;{{ money_format('%(#3i', $order->cost()) }}<br/>
                @if ($order->discount() > 0)
                Discount: &pound;{{ money_format('%(#3i', $order->discount()) }}<br/>
                @endif
                @if ($order->amount_extra > 0)
                Extra: &pound;{{ money_format('%(#3i', $order->amount_extra) }}<br/>
                @endif
                Total: &pound;{{ money_format('%(#3i', $order->total()) }}<br/>
            @else
                &pound;{{ money_format('%i', $order->total()) }}
            @endif
            </td>
        </tr>

    </table>
    
    <hr/>

    <p><small>
        Causeway Coast Vineyard<br/>
        10 Hillmans Way<br/>
        Ballycastle Road<br/>
        Coleraine<br/>
        BT52 2ED
    </small></p>

</body>

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

        <tr valign="top">
            <td nowrap>Order reference</td>
            <td>{{ $order->transaction_id }}</td>
        </tr>

        <tr valign="top">
            <td nowrap>Contact details</td>
            <td>
                {{{ $order->name() }}}<br/>
                {{{ $order->email }}}<br/>
                {{{ $order->phone }}}
            </td>
        </tr>

        <tr valign="top">
            <td nowrap>Children</td>
            <td>
                <table border="0" cellspacing="2" cellpadding="2">
                @foreach ($order->children as $child)
                    <tr>
                        <td>Name</td>               
                        <td>{{ $child->name() }}</td>
                    </tr>
                    <tr>
                        <td>Date of birth</td>      
                        <td>{{ $child->date_of_birth->format('jS F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Age on August 3rd</td>  
                        <td>{{ $child->age() }}</td>
                    </tr>
                    <tr>
                        <td>T-shirt size</td>       
                        <td>{{ $child->tshirt }}</td>
                    </tr>
                    <tr>
                        <td>Dancing</td>            
                        <td>{{ $child->dancing ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td>Sleepover</td>          
                        <td>{{ $child->sleepover ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
                </table>
            </td>
        </tr>

        <tr valign="top">
            <td nowrap>Permissions</td>
            <td>
                Photographs: {{ $order->photos_permitted ? 'Yes' : 'No' }}<br/>
                Outings: {{ $order->outings_permitted ? 'Yes' : 'No' }}
            </td>
        </tr>

        <tr valign="top">
            <td nowrap>Price</td>
            <td>
                @if ($order->cost() != $order->total())
                <table border="0" cellspacing="2" cellpadding="2">
                    <tr><td>Cost</td>     <td>£{{ money_format('%(#3i', $order->cost()) }}</td></tr>
                    @if ($order->discount() > 0)
                    <tr><td>Discount</td> <td>£{{ money_format('%(#3i', $order->discount()) }}</td></tr>
                    @endif
                    @if ($order->amount_extra > 0)
                    <tr><td>Extra</td>    <td>£{{ money_format('%(#3i', $order->amount_extra) }}</td></tr>
                    @endif
                    <tr><td>Total</td>    <td>£{{ money_format('%(#3i', $order->total()) }}</td></tr>
                </table>
                @else
                    £{{ money_format('%i', $order->total()) }}
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
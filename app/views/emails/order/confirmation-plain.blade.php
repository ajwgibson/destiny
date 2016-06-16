
Thank you for your order. Please print these details and bring them with you on the first morning
to make the registration process quicker and easier.


Here are the full details of your order:


Order reference:        {{{ $order->transaction_id }}}


Contact name:           {{{ $order->name() }}}
Contact email:          {{{ $order->email }}}
Contact phone:          {{{ $order->phone }}}


Children:

@foreach ($order->children as $child)
    Name:                      {{ $child->name() }}
    Date of birth:             {{ $child->date_of_birth->format('jS F Y') }}
    Age on August 3rd:         {{ $child->age_at_start() }}
    School year in September:  {{ $child->school_year() }}
    T-shirt size:              {{ $child->tshirt }}
    Dancing:                   {{ $child->dancing ? 'Yes' : 'No' }}
@if (!($child->dancing))
    Activity preferences:      {{ $child->activity_choice_1 }}
                               {{ $child->activity_choice_2 }}
                               {{ $child->activity_choice_3 }}
@endif
    Destiny HighLand:          {{ $child->sleepover ? 'Yes' : 'No' }}
    Medical warning:           {{ $child->health_warning ? 'Yes' : 'No' }}
    Notes:                     {{ $child->notes }}

@endforeach


Permissions:
            
    Photographs:  {{ $order->photos_permitted ? 'Yes' : 'No' }}
    Outings:      {{ $order->outings_permitted ? 'Yes' : 'No' }}
            

Price:
@if ($order->cost() != $order->total())
    Cost:       £{{ money_format('%(#3i', $order->cost()) }}
@if ($order->discount() > 0)
    Discount:   £{{ money_format('%(#3i', $order->discount()) }}
@endif
@if ($order->amount_extra > 0)
    Extra:      £{{ money_format('%(#3i', $order->amount_extra) }}
@endif
    Total:      £{{ money_format('%(#3i', $order->total()) }}
@else
    £{{ money_format('%i', $order->total()) }}
@endif



Causeway Coast Vineyard
10 Hillmans Way
Ballycastle Road
Coleraine
BT52 2ED



@if ($order->status == Order::StatusComplete)
<h3><span class="glyphicon glyphicon-tag"></span> Order reference</h3>
<dl class="dl-horizontal">
    <dt>#</dt> <dd><span class="h4 name">{{ $order->transaction_id }}</span></dd>
</dl>
@endif

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
    <dt>Age on August 3rd</dt>                 <dd>{{ $child->age_at_start() }}</dd>
    <dt>School year in September</dt>          <dd>{{ $child->school_year() }}</dd>
    <dt>T-shirt size</dt>                      <dd>{{ $child->tshirt }}</dd>
    <dt>Dancing</dt>                           <dd>{{ HTML::yes_no_icon($child->dancing) }}</dd>
    @if (!($child->dancing))
    <dt>Activity preferences</dt>              <dd>{{ $child->activity_choice_1 }}</dd>
                                               <dd>{{ $child->activity_choice_2 }}</dd>
                                               <dd>{{ $child->activity_choice_3 }}</dd>
    @endif
    <dt>Destiny HighLand</dt>                  <dd>{{ HTML::yes_no_icon($child->sleepover) }}</dd>
    <dt>Medical warning</dt>                   <dd>{{ HTML::yes_no_icon($child->health_warning) }}</dd>
    <dt>Notes</dt>                             <dd>{{ nl2br($child->notes) }}</dd>
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
<dl class="dl-horizontal hidden-print">
    <dt>Cost</dt>     <dd><span class="price">£{{ money_format('%(#3i', $order->cost()) }}</dd>
    @if ($order->discount() > 0)
    <dt>Discount</dt> <dd><span class="price">£{{ money_format('%(#3i', $order->discount()) }}</dd>
    @endif
    @if ($order->amount_extra > 0)
    <dt>Extra</dt>    <dd><span class="price">£{{ money_format('%(#3i', $order->amount_extra) }}</dd>
    @endif
    <dt>Total</dt>    <dd><span class="price">£{{ money_format('%(#3i', $order->total()) }}</dd>
</dl>
<dl class="dl-horizontal visible-print">
    <dt></dt>  <dd>£{{ money_format('%i', $order->total()) }}</dd>
</dl>
@else
<dl class="dl-horizontal">
    <dt><span class="sr-only">Cost</span></dt>  <dd>£{{ money_format('%i', $order->total()) }}</dd>
</dl>
@endif



<div class="col-sm-8 show_panel">

    <h3><span class="glyphicon glyphicon-user"></span> Child details</h3>

    <dl class="dl-horizontal">

        <dt>First name</dt>             
        <dd>{{{ $child->first_name }}}</dd>

        <dt>Last name</dt>         
        <dd>{{{ $child->last_name }}}</dd>

        <dt>Date of birth</dt>                     
        <dd>{{{ $child->date_of_birth->format('jS F Y') }}}</dd>

        <dt>Age on August 3rd</dt>                 
        <dd>{{ $child->age_at_start() }}</dd>

        <dt>School year in September</dt>          
        <dd>{{ $child->school_year() }}</dd>

        <dt>T-shirt size</dt>                      
        <dd>{{ $child->tshirt }}</dd>

        <dt>Dancing</dt>                           
        <dd>{{ HTML::yes_no_icon($child->dancing) }}</dd>

        @if (!($child->dancing))
        <dt>Activity preferences</dt>              
        <dd>{{ $child->activity_choice_1 }}</dd>
        <dd>{{ $child->activity_choice_2 }}</dd>
        <dd>{{ $child->activity_choice_3 }}</dd>
        @endif

        <dt>Destiny HighLand</dt>                  
        <dd>{{ HTML::yes_no_icon($child->sleepover) }}</dd>

        <dt>Medical warning</dt>                   
        <dd>{{ HTML::yes_no_icon($child->health_warning) }}</dd>

        <dt>Notes</dt>                             
        <dd>{{ nl2br($child->notes) }}</dd>

        <dt>Order</dt>
        <dd>
            @if ($child->order)
                {{ link_to_route(
                    'admin.order.show', 
                    $child->order->name(), 
                    $parameters = array( 'id' => $child->order->id), 
                    $attributes = array( 'class' => '')) }}
            @else
                <i>Not used yet</i>
            @endif
        </dd>
    </dl>
        
</div>

<div class="col-sm-4 edit_delete_panel">

    <h4>Actions</h4>

    <div class="action">
        {{ link_to_route(
            'admin.child.edit', 
            'Edit child', 
            $parameters = array( 'id' => $child->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

</div>



@section('extra_js')

<script type="text/javascript">
    
</script>

@endsection


<div class="row">
    <div class="col-md-8" id="inner-content">

        <div class="row">
            <section class="col-xs-10">
                <p class="lead">
                @if ($order->children->count() == 0)
                    You haven't added any children to the order yet. 
                @else
                    These are the children currently associated with the order.
                @endif
                </p>
            </section>
        </div>

        <div class="row">
            <div class="col-xs-8">
                {{ link_to_route(
                        'admin.order.child', 
                        'Add a child', 
                        $parameters = array('transaction_id' => $order->transaction_id), 
                        $attributes = array('class' => 'btn btn-success')) }}
            </div>
        </div>

        <div class="row top-20">
            <div class="col-sm-8">
                @foreach ($order->children as $child)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{{ $child->name() }}}</h4>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
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
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            <a href="{{ route('admin.order.child', 
                                            array(
                                                'transaction_id' => $order->transaction_id,
                                                'child_id' => $child->id)) }}" 
                               class="btn btn-xs btn-link"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                            <a href="{{ route('admin.order.remove.child', 
                                            array(
                                                'transaction_id' => $order->transaction_id,
                                                'child_id' => $child->id)) }}" 
                               class="btn btn-xs btn-link"><span class="text-danger"><span class="glyphicon glyphicon-remove"></span> Remove</span></a>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>
                </div>
                @endforeach
            </div>    
        </div>

        <div class="row top-20 bottom-40">
            <section class="col-xs-10">
                {{ HTML::wizard_previous('admin.order.contact_details', array('transaction_id' => $order->transaction_id)) }}
                {{ HTML::wizard_next_link(
                    'admin.order.permissions', 
                    $order->children->count() > 0 ? false : true, 
                    array('transaction_id' => $order->transaction_id)) }}
            </section>
        </div>

    </div>

    <div class="col-md-4 hidden-print" id="sidebar">
        @include('orders/_sidebar')
    </div>

</div>

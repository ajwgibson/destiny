@extends('layouts/frontend')

@section('content')

<div class="jumbotron">

    <h1>The Kids Awaken</h1>

    <p>
        Each morning, 10am to 1pm will be packed with awesome games, activities, music, 
        competitions, prizes and much more! Each child will receive a Destiny Island: Kids Awaken T-Shirt 
        as part of their involvement.
    </p>
 
    <p>
        We have an extra for those aged 10 and over; code-named “Destiny HighLand”. This is an 
        opportunity to stay overnight on site from Thursday morning to Friday lunchtime. We will go 
        on ‘mission’ to give the love of Jesus away in the afternoon in our town, then we will 
        back for food and a sleep over in the church building. All meals will be catered for (£6 extra).
    </p>
        
    <p> 
        We are closing the week with a Family Fun Night &amp; BBQ from 6.30pm at CCV on Friday 5th. 
        All families from Destiny Island are invited to this event.
    </p>
        
    <p> 
        Can't wait to see you!
    </p>

    <p>
        @if (Session::has('transaction_id'))
        
        {{ link_to_route(
            'order.contact_details', 
            'Continue your booking', 
            $parameters = array( ), 
            $attributes = array('class' => 'btn btn-primary btn-lg')) }}

        {{ link_to_route(
            'order.new', 
            'Start a new booking', 
            $parameters = array( ), 
            $attributes = array('class' => 'btn btn-default btn-lg')) }}            

        @else
        
        {{ link_to_route(
            'order.contact_details', 
            'Book your place now', 
            $parameters = array( ), 
            $attributes = array('class' => 'btn btn-primary btn-lg')) }}

        @endif
    </p>
</div>

<div class="row bottom-40">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading text-center">
                <h2>Pricing details</h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-info text-center pricing">
                            <div class="panel-heading">
                                <h3>Conference pass</h3>
                                <p>£10</p>
                            </div>
                            <div class="panel-body">
                                <p>
                                    <i>
                                        Entry to our daily sessions packed with awesome games, activities, music, 
                                        competitions, prizes and more.
                                    </i>
                                </p>
                            </div>  
                            <ul class="list-group">
                                <li class="list-group-item">Wed - Fri</li>
                                <li class="list-group-item">10am - 1pm</li>
                                <li class="list-group-item">T-Shirt included</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-info text-center pricing">
                            <div class="panel-heading">
                                <h3>Destiny High-Land</h3>
                                <p>£6</p>
                            </div>
                            <div class="panel-body">
                                <p>
                                    <i>
                                        Thursday afternoon 'mission' in town followed by
                                        dinner and an overnight stay in the church.<br>
                                        (for children aged 10 and older)
                                    </i>
                                </p>
                            </div>  
                            <ul class="list-group">
                                <li class="list-group-item">Thu - Fri</li>
                                <li class="list-group-item">10am Thursday - 10am Friday</li>
                                <li class="list-group-item">Dinner included</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('sidebar')

<img src="{{ asset('images/destiny-island.jpg') }}" class="img-responsive img-thumbnail" alt="Destiny Island">
<div class="panel">
    <div class="panel-body">
        <address>
            <span class="h3">Destiny Island 2016</span><br>
            <span class="h4">Wed Aug 3rd - Fri Aug 5th</span><br>
            <span class="h5">10am - 1pm</span><br>
            <span class="h5">Ages 5 - 11</span>
        </address>
        <address>
            <strong>Address</strong><br>
            10 Hillmans Way, Ballycastle Road<br>
            Coleraine, Co. Londonderry<br>
            BT52 2ED<br>
            <abbr title="Telephone">Tel:</abbr> 028 7032 6161
        </address>
        <address>
            <a target="_blank" href="https://goo.gl/maps/jcgGv">View location on map</a>
        </address>
    </div>
</div>

@stop
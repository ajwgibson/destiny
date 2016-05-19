@extends('layouts/frontend')

@section('content')

<div class="jumbotron">
    <h1>Welcome</h1>
    <p>
        To three days full of adventure for primary aged kids, filled with loads of fun,
        where we’ll be unpacking loads of excitement through activities, games, and more! 
    </p>
    <p>
        And this year we're also running an overnight event for kids who are eleven or older!
    </p>
    <p>
        Destiny Island is designed to help kids understand God’s love for them and show 
        them how to give it away. Come join us in this wild, crazy, adventure called Destiny Island!
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

<div class="row">
    <div class="col-md-12">
        <h3>Pricing details</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default text-center pricing">
            <div class="panel-heading">
                <h2>Standard</h2>
                <p>£10</p>
            </div>
            <div class="panel-body">
                <p>
                    <i>Entry to morning activities including Nerf challenge, Score football, Cooking, Flashdance.</i>
                </p>
            </div>  
            <ul class="list-group">
                <li class="list-group-item">Wed - Fri</li>
                <li class="list-group-item">10:00am - 12:30pm</li>
                <li class="list-group-item">T-Shirt included</li>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default text-center pricing">
            <div class="panel-heading">
                <h2>Sleepover</h2>
                <p>£6</p>
            </div>
            <div class="panel-body">
                <p>
                    <i>An overnight stay for children aged 11 or older.</i>
                    <br><br>
                </p>
            </div>  
            <ul class="list-group">
                <li class="list-group-item">Thu</li>
                <li class="list-group-item">12:30pm - 10:00am</li>
                <li class="list-group-item">Pizza included</li>
            </ul>
        </div>
    </div>
</div>

@stop


@section('sidebar')

<img src="{{ asset('images/destiny-island.jpg') }}" class="img-responsive img-thumbnail" alt="Destiny Island">
<div class="panel">
    <div class="panel-body">
        <address>
            <span class="h4">Wed Aug 3rd - Fri Aug 5th</span><br>
            <span class="h5">10:00am - 12:30pm</span>
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
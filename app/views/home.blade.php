@extends('layouts/frontend')

@section('content')

<div class="row bottom-10">
    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading text-center">
                <h2>Online booking has now closed!</h2>
            </div>
        </div>
    </div>
</div>

<div class="jumbotron">

    <h1>Destiny Island</h1>
    
    <h2>The Kids Awaken</h2>

    <p>
        Each morning, 10am to 1pm will be packed with awesome games, activities, music, 
        competitions, prizes and much more! Each child will receive a Destiny Island: Kids Awaken T-Shirt 
        as part of their involvement.
    </p>
 
    <p>
        We have an extra for those aged 10 and over; code-named “Destiny HighLand”. This is an 
        opportunity to stay overnight on site from Thursday morning to Friday lunchtime. We will go 
        on ‘mission’ to give the love of Jesus away in the afternoon in our town, then we will 
        be back for food and a sleep over in the church building. All meals will be catered for (£6 extra).
    </p>
        
    <p> 
        We are closing the week with a Family Fun Night &amp; BBQ from 6.30pm at CCV on Friday 5th. 
        All families from Destiny Island are invited to this event.
    </p>
        
    <p> 
        Can't wait to see you!
    </p>

</div>

<div class="row bottom-10">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading text-center">
                <h2>Pricing details</h2>
            </div>
        </div>
    </div>
</div>
<div class="row bottom-20">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-info text-center pricing">
                    <div class="panel-heading">
                        <h3>Conference Pass</h3>
                        <p>£10</p>
                    </div>
                    <div class="panel-body">
                        <p>
                            <i>
                                Entry to our daily sessions packed with awesome games, activities, music, 
                                competitions, prizes and more!
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
                        <h3>Destiny HighLand</h3>
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
                        <li class="list-group-item">10am Thursday - 1pm Friday</li>
                        <li class="list-group-item">Dinner included</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('sidebar')
    @include('_sidebar')
@stop
@extends('layouts/error')

@section('content')

    <div class="jumbotron">
        <h1><span class="glyphicon glyphicon-exclamation-sign"></span> Whoops</h1>
        <p class="small"><code>Error code: {{ $error_code }}</code></p>
        <p>
            This is a little awkward, but something went wrong when we tried to
            process your request. Can we ask you to try again?
        </p>
        <p>
            If you think there's a problem with our site, please let us know
            using the following email address:<br>
            <span class="small"><a href="mailto:kids@causewaycoastvineyard.com">kids@causewaycoastvineyard.com</a></small>
        </p>
        <p>
            If you're really lost, you can get back to our homepage using this link:<br>
            <span class="small"><a href="{{ route('home') }}">{{ route('home') }}</a></small>
        </p>
    </div>

@stop

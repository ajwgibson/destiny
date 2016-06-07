@extends('layouts/frontend')

@section('content')

<div class="row">
    <div class="col-sm-10">
        <h1>Frequently asked questions</h1>
        <p class="lead">
            If you have any questions about Destiny Island you will hopefully find the
            answers here. If your question is not answered here, please feel free to contact
            us by email at <a href="mailto:kids@causewaycoastvineyard.com">kids@causewaycoastvineyard.com</a>
            or by contacting the church office.
        </p>
    </div>
</div>

@foreach ($faqs as $faq)
<div class="row">
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div class="media-left">
                        <div class="media-object"><span class="glyphicon glyphicon-question-sign"> </span></div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ nl2br($faq->question) }}</h4>
                        <p>{{ nl2br($faq->answer) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@stop


@section('sidebar')
    @include('_sidebar')
@stop
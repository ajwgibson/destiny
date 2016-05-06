<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CCV Destiny Island">

    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <title>Destiny Island | Causeway Coast Vineyard</title>

    <link rel="stylesheet" href="{{ asset('assets/stylesheets/frontend.css') }}">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

        <!-- Fixed navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top hidden-print" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="{{ asset('images/logo.png') }}" class="navbar-brand" alt="Causeway Coast Vineyard">
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">{{ link_to_route('home', 'HOME') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Begin page content -->
        <div class="container" id="main-content">



            <div class="row">
                <div class="col-md-8">

                    @if (Session::has('info'))
                    <div class="alert alert-info alert-dismissable">
                        <p>{{ Session::get('info') }}</p>
                    </div>
                    @elseif (isset($info))
                    <div class="alert alert-info alert-dismissable">
                        <p>{{{ $info }}}</p>
                    </div>
                    @endif

                    @if (Session::has('message'))
                    <div class="alert alert-danger alert-dismissable">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                    @elseif (isset($message))
                    <div class="alert alert-danger alert-dismissable">
                        <p>{{{ $message }}}</p>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="panel panel-danger">
                        <div class="panel-heading">Validation Errors</div>
                        <div class="panel-body">
                            <ul>
                                {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                            </ul>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            @yield('content')
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    @yield('sidebar')
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/javascript/frontend.js') }}"></script>

    @yield('extra_js')

</body>

</html>

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
                    <img src="{{ asset('images/logo.png') }}" class="navbar-brand" alt="Causeway Coast Vineyard">
                </div>
            </div>
        </div>

        <!-- Begin page content -->
        <div class="container" id="main-content">
            <div class="row" style="padding-top: 50px;">
                <div class="col-sm-8 col-sm-offset-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</body>

</html>

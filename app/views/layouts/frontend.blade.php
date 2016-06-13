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

    <script type="text/javascript" src="//use.typekit.net/ik/Q3jd9lYe1tkUjh4E4N6KU9l8gsIsmg4WYtgLKUj9-pIfe0bffFHN4UJLFRbh52jhWD9DwQwt5ABKZQsKw2IojD9kZQwDZR9u5gTaiaiaOcFyiWF8ihBojhNySash-Ao8pABkZfoRdhXCjhBuShmajW8RdhBDiYZTdcmojW4qOcFzdPUCdhFydeyzSabCjhFhjhyuScFGO1FUiABkZWF3jAF8OcFzdP37OcFRicFGiW4R-foDSWmyScmDSeBRZPoRdhXK2YgkdayTdAIldcNhjPJHjcmKjWwldcmuZPG4fHCgIMMjMPMfH6qJnMIbMg6OJMJ7fbRKHyMMeMw6MKG4f5w7IMMj2PMfH6qJn3IbMg6IJMJ7fbK3MsMMeMt6MKG4fHXgIMMjgKMfH6qJn6IbMg6bJMJ7fbKOMsMMeMS6MKG4fJ3gIMMjIPMfH6qJ7bIbMg6JJMJ7fbK7MsMMegJ6MKG4fJqgIMMjfPMfH6qJK6IbMg6QJMJ7fbRL-gMgeMb6MTMg3SnhnM9.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

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
                    <div class="navbar-logo">
                        <img src="{{ asset('images/logo.png') }}" class="img-responsive" alt="Causeway Coast Vineyard">
                    </div>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">{{ link_to_route('home', 'HOME') }}</li>
                        <li class="">{{ link_to_route('faqs', 'FAQS') }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Begin page content -->
        <div class="container" id="main-content">

            <div class="row">

                <div class="col-md-8" id="inner-content">

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

                <div class="col-md-4 hidden-print" id="sidebar">
                    @yield('sidebar')
                </div>

            </div>

            
        </div>

        <footer class="footer">
            <div class="container">
                <p class="text-muted">&copy; 2016 CAUSEWAY COAST VINEYARD. ALL RIGHTS RESERVED.</p>
            </div>
        </footer>
    </div>

    <!-- JavaScript placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/javascript/frontend.js') }}"></script>


    @yield('extra_js')

</body>

</html>

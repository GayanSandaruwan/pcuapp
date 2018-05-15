<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Multi Auth Guard') }}</title>

    <!-- Styles -->

    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">
    {{--<link href="/css/app.css" rel="stylesheet">--}}

    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <!-- Scripts -->

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>
    <script type="text/javascript" src="/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker.min.css"></script>
    <script type="text/javascript" src="/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<header>
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark cyan">
        <a class="navbar-brand" href="javascript:;;">PCU App</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent-4" style="">
            <ul class="navbar-nav ml-auto">
                @if (Auth::guest())
                    <li><a href="{{ url('/nurse/login') }}"><button type="button" class="btn" style="border-radius: 50px; border-color: #98cbe8;">Login</button></a></li>
                @else
                    <li class="nav-item active">
                        <a class="nav-link waves-effect waves-light" href="{{ url('/nurse/patient/add') }}">
                            <i class="fa fa-wheelchair"></i> Add Patient</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>  {{ Auth::user()->name }} </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                            <ul>
                                <li>
                                    <a href="{{ url('/nurse/logout') }}"
                                       onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/nurse/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li>
                                    <a href="{{ url('/nurse/password/reset') }}">
                                        Reset Password
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
<main>
    @yield('content')

</main>

    <!-- Scripts -->
    {{--<script src="/js/app.js"></script>--}}
</body>
</html>

<body>

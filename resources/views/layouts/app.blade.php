<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="/favicon.png" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $user->nickname }} - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    @if($user->theme == 1)
        <link rel="stylesheet" href="/css/themes/stale-bootstrap.min.css">
    @endif

    @yield('styles')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/me') }}">
                        {{ config('app.name', 'Laravel') }} <span class="badge">Beta Tester</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ url('/me') }}">{{ trans('menus.status') }}
                            @if($user->trainFinished())
                                <span class="label label-success">{{ trans('menus.completed') }}</span>
                            @else
                                @if($user->isTraining())
                                    <span class="glyphicon glyphicon-time"></span>
                                @endif
                            @endif

                            @if($user->mastery_points && !$user->training_mastery)
                                <span class="label label-danger">{{ $user->mastery_points }}</span>
                            @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/adventures') }}">{{ trans('menus.adventures') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/treasures') }}">{{ trans('menus.treasures') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/arena') }}">{{ trans('menus.arena') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/ranking') }}">{{ trans('menus.ranking') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/guild') }}">{{ trans('menus.guild') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="navbar-form">
                                <form method="POST" action="{{ url('change-theme') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="theme" value="{{ $user->theme == 1 ? 0 : 1}}">
                                    <button class="btn btn-default" type="submit">Trocar Tema</button>
                                </form>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->nickname }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('donations') }}">{{ trans('menus.donations') }}</a>
                                        <a href="#">Feedback</a>
                                        {{-- <a href="{{ url('/donation') }}">Donation</a> --}}
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                @include('partials/profile')

                <div class="col-md-8">
                    @include('partials/flash')
                    @yield('content')
                </div>
            </div>
        </div>

        <chat></chat>
    </div>




    @if(! $user->hasNickname())
        @include('modals/ask-name-modal')
    @endif
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    @yield('scripts')
    <script>
        @if($user->hasEnoughExperience())
            window.onload = function(){
                blinkTitle('You leveled up! ');
            }
        @endif

        @if(session('levelUp') || session('newClass'))
            window.onload = function(){
                var audio = new Audio('/sounds/level-up.wav');
                audio.play();
            }
        @endif

        @if(! $user->hasNickname())
            window.onload = function(){

                $('#ask-name-modal').on('show.bs.modal', function (event) {
                    $('#nickname').focus();
                });

                $('#ask-name-modal').modal();
            }
        @endif
    </script>
</body>
</html>

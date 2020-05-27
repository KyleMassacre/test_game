<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>@yield('title', env('APP_NAME'))</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ theme_url('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="wrapper" id="app">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>{{ env('APP_NAME') }}</h3>
        </div>
        @auth
            <div class="profile">
                <div class="text-center">
                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/mantia/128.jpg">
                    <p>
                    <h6 class="text-center">{{ auth()->user()->name }}</h6>
                    </p>
                </div>
                <div class="stats">
                    @each('partials.stats', auth()->user()->stats, 'stat')
                </div>
            </div>
        @endauth
        <ul class="list-unstyled components">
            @auth
                @if(app('core.indashboard'))
                    @include('partials.sidebar.dashboard')
                @else
                    @include('partials.sidebar.ingame')
                @endif
            @endauth
            @guest
                @include('partials.sidebar.public')
            @endguest
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn text-sidebar bg-turbo-yellow">
                    <i class="fas fa-align-justify"></i>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ auth()->user()->name }}
                                    <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main role="main" class="col-lg-12">
            @yield('content')
        </main>
    </div>
</div>
@stack('styles')
<script src="{{ theme_url('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>

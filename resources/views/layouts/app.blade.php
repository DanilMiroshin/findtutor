<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ url('imgs/icons/logo.png')}}" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('layout.title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('custom-styles')
</head>
<body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img alt="logo" width="100%" src="{{ url('imgs/icons/logo.png') }}">

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class='nav-link' href="{{ url('/search') }}">@lang('layout.navbar.search')</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class='nav-link' href="{{ url('/login') }}">@lang('layout.navbar.login')</a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link' href="{{ url('/register') }}">@lang('layout.navbar.signup')</a>
                        </li>
                    @else
                        @if (Auth::user()->role->isAdmin == 1)
                            <li class="nav-item">
                                <a class='nav-link' href="{{ url('/admin') }}">@lang('layout.navbar.admin')</a>
                            </li>
                        @endif  
                        <li class="nav-item">
                            <a class='nav-link' href="{{ url('user/'. Auth::id() .'/settings') }}">@lang('layout.navbar.settings')
                                @if (Auth::user()->unreadNotifications->isNotEmpty())
                                    <span class="badge badge-warning">!</span>
                                @endif
                            </a>
                        </li>
                    <li class="nav-item">
                        <a class='nav-link' onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                            href="{{ route('logout') }}">
                                            {{ Auth::user()->first_name }}  (@lang('layout.navbar.logout'))
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <main class="content">
            @yield('content')
        </main>
    <footer>
        <div class='ftr-menu'>
            <div class="row">
                <div class="col">
                    <ul>
                        <li class='ul-header'>@lang('layout.footer.subjects')</li>
                        <li><a href="{{ URL('/search/find/?subject=Математика&range=1500') }}">Математика</a></li>
                        <li><a href="{{ URL('/search/find/?subject=Химия&range=1500') }}">Химия</a></li>
                        <li><a href="{{ URL('/search/find/?subject=Русский+язык&range=1500') }}">Русский язык</a></li>
                    </ul>
                </div>
                <div class="col">
                    <div class="row">
                        <a href="#">
                            <img class='pb-1' src="{{ url('imgs/icons/github.png')}}">
                        </a>
                        <a href="#" class='pl-2'>
                            <img class='pb-1' src="{{ url('imgs/icons/instagram.png')}}">
                        </a>
                        <a href="#" class='pl-2'>
                            <img class='pb-1' src="{{ url('imgs/icons/twitter.png')}}">
                        </a>           
                    </div>
                    <div class="row">
                        <span class='ftr-copyright'>
                            Copyright © 2020 Find tutor. 
                            @lang('layout.footer.rights')
                        </span><br>
                    </div>
                    <div class="row">
                        <span class='ftr-credits'>
                                Icons from 
                            <a href="https://www.flaticon.com/" title="Flaticon"> 
                                www.flaticon.com
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
     </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel='stylesheet' type='text/css' href="css/app.css" />

        <title>Dog Boarding</title>

    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ route('home') }}">Dog Books</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item {{\Request::route()->getName()=='home' ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item {{\Request::route()->getName()=='newData' ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('newData') }}">New Data</a>
                        </li>
                        <li class="nav-item dropdown {{\Request::route()->getName()=='profile' ? 'active' : ''}}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profiles
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('profile',['model' => 'dog', 'id' => 1]) }}">Dogs</a>
                                <a class="dropdown-item" href="{{ route('profile',['model' => 'owner', 'id' => 1]) }}">Owners</a>
                                <a class="dropdown-item" href="{{ route('profile',['model' => 'boardingbooking', 'id' => 1]) }}">Boarding Bookings</a>
                                <a class="dropdown-item" href="{{ route('profile',['model' => 'address', 'id' => 1]) }}">Addresses</a>
                                <a class="dropdown-item" href="{{ route('profile',['model' => 'dogsize', 'id' => 1]) }}">Dog Sizes</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        @yield('content')
        <footer></footer>
    </body>
</html>
<script type="text/javascript" src="js/app.js"></script>

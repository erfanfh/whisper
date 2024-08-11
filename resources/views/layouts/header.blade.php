<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Whisper!</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link href="{{ asset('/icon/css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('/icon/css/brands.css') }}" rel="stylesheet" />
    <link href="{{ asset('/icon/css/solid.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="{{ asset('Images/Logo/png/logo-no-background.png') }}">

</head>

<body>
<nav style="background-color: white !important;" class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-flex">
        <a class="navbar-brand logo" href="{{ route('dashboard') }}">Whisper!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="header-sec collapse navbar-collapse" id="navbarNav">
            @guest()
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            @endguest
            @auth()
                <ul class="navbar-nav pe-5">
                    <li class="nav-item dropdown pe-5">
                        <button class="border-0 btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="border-0  dropdown-menu">
                            <li>
                                <a class="dropdown-item" aria-current="page" href="{{ route('profile.show', auth()->user()->username) }}">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" aria-current="page" href="{{ route('contact.index') }}">Contacts</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>

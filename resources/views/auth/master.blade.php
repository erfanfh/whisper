<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Whisper!')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <link href="{{ asset('/icon/css/fontawesome.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/icon/css/brands.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/icon/css/solid.css') }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="icon" type="svg" href="{{ asset('Images/Logo/svg/logo-no-background.svg') }}">


</head>

<body>

<div>
    @include('layouts.navbar')
    <div class="row justify-content-center align-item-center">
        <div class="form col-12 col-md-10 d-flex m-5 auth-form justify-content-center">
            <div class="col-12 col-md-6">
                @yield('content')
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
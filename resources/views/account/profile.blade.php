@include('layouts.header')

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div>
    <div>
        <div class="background">
            <div class="bio-box pt-5 cover">
                <div class="media align-items-end">
                    <div class="profile mr-3 d-flex flex-column">
                        <img src="{{ asset('Images/Profiles/' . $user->profile->image) }}" alt="Profile Photo" height="200" width="200" class="prof-img rounded-circle mb-4">
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="fs-1 mt-0 mb-0">{{ $user->name }}</h4>
                        <p class="fs-6 data-info mb-4"> <i class="fas fa-calendar-days mr-2"></i>
                            <span class="fw-lighter">Joined at </span>
                            <span class="fw-lighter">{{ $user->created_at->format('M Y') }}</span>
                        </p>
                        @auth()
                            @if(auth()->user()->username == $user->username)
                                <a href="{{ route('profile') }}" class="btn btn-outline-light btn-sm btn-block">Edit profile</a>
                            @endif
                            @if(session('success'))
                                <div class="mt-3 alert alert-success">{{session('success')}}</div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="username-box">
                <h5 class="mb-2">Username</h5>
                <div class="rounded shadow-sm bg-light username-box">
                    <p class="font-monospace mb-0">
                        @
                        <span class="">{{$user->username}}</span>
                    </p>
                </div>
            </div>
            <div class="bio-box">
                <h5 class="mb-2">Bio</h5>
                <div class="rounded shadow-sm bg-light bio-box">
                    <p class="font-italic mb-0">{{ $user->profile->bio }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>



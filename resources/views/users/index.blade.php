<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="fs-1 fw-bold">
            Result
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <hr>
        @if(empty($users->all()))
            <div class="fs-5 fw-light">
                Sorry, Not any user found!
            </div>
        @endif
        @foreach($users as $user)
            @if($user->id != auth()->user()->id)
            <div class="d-flex flex-column p-4 my-3 post-sec">
                <div class="d-flex justify-content-between align-items-center mb-10">
                    <div class="d-flex gap-3">
                        <a href="{{ route('profile.show', $user->username) }}">
                            <img alt="Profile" class="post-user-prof rounded-circle" src="{{ asset('Images/Profiles/' . $user->profile->image) }}">
                        </a>
                        <div style="grid-gap: 5px" class="d-flex">
                            <div class="d-flex align-items-center mb-10 sender">
                                <a style="color: black" href="{{ route('profile.show', $user->username) }}">
                                    <div class="fw-bold">
                                        @if(auth()->user()->contacts->where('belongs_id', $user->id)->first())
                                            {{ auth()->user()->contacts->where('belongs_id', $user->id)->first()->name }}
                                            <i class="fa fa-user-friends"></i>
                                        @else
                                            {{ $user->username }}
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
@endsection

</body>
</html>

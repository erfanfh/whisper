@extends('layouts.master')
@section('content')
    <nav class="navbar bg-body-white border-bottom border-dark-subtle position-absolute top-0 end-0 w-75">
        <div class="container-fluid">
{{--            <a class="navbar-brand fs-3" href="{{ route('groups.show', ['group' => $group->id]) }}">{{ $group->name }}</a>--}}
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#groupInfoModal">
                {{ $group->name }}
                <i class="fa fa-user-friends"></i>
                <i class="fa fa-chevron-right"></i>
            </button>
            <div class="modal fade" id="groupInfoModal" tabindex="-1" aria-labelledby="groupInfoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="groupInfoModalLabel">Users </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="list-group">
                                @foreach($group->users as $user)
                                    @if(auth()->user()->contacts->where('belongs_id', $user->id)->first())
                                        <img src="{{ asset('Images/Profiles' . "/" . $user->profile->image) }}" alt="profile">
                                        <a href="{{ route('profile.show', ['username' => $user->username]) }}" class="list-group-item list-group-item-action">{{ auth()->user()->contacts->where('belongs_id', $user->id)->first()->name }}</a>
                                    @else
                                        <img src="{{ asset('Images/Profiles' . "/" . $user->profile->image) }}" alt="profile">
                                        <a href="{{ route('profile.show', ['username' => $user->username]) }}" class="list-group-item list-group-item-action">{{ $user->name }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div style="margin-top: 5rem" class="container">
        <div class="form-container">
            <form action="{{ route('posts.store', ['group' => $group]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <textarea class="form-control mb-3" name="message" placeholder="Say you're in love with me..." rows="3"></textarea>
                </div>
                @error('message')
                <div class="alert alert-secondary">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit">Whisper</button>
            </form>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @foreach($posts as $post)
            <div class="d-flex flex-column p-4 my-3 post-sec">
                <div class="d-flex justify-content-between align-items-center mb-10">
                    <div>
                        <a href="{{ route('profile.show', $post->user->username) }}">
                            <img alt="Profile" class="post-user-prof rounded-circle" src="{{ asset('Images/Profiles/' . $post->user->profile->image) }}">
                        </a>
                        <div style="grid-gap: 5px" class="d-flex">
                            <div class="d-flex align-items-center mb-10 sender">
                                <a style="color: black" href="{{ route('profile.show', $post->user->username) }}">
                                    <div class="fw-bold">
                                        @if(empty(auth()->user()->contacts->where('belongs_id', $post->user->id)->all()))
                                            @if(auth()->user()->id == $post->user->id)
                                                You
                                            @else
                                                {{ $post->user->username }}
                                            @endif
                                        @else
                                            {{ auth()->user()->contacts->where('belongs_id', $post->user->id)->first()->name }}
                                        @endif
                                    </div>
                                </a>
                                <div style="color: #555" class="x-small date-time">{{ $post->created_at->format('j/m/Y, H:i') }}</div>
                                @if($post->edited)
                                    <div class="x-small date-time">Edited</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->id == $post->user->id)
                        <div class="d-flex edit-sec x-small">
                            <a style="color: gray" href="{{ route('posts.edit', $post) }}">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <span style="color: #cbd5e0">|</span>
                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-but"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="mt-10">
                    {{ $post->message }}
                </div>
            </div>
        @endforeach
    </div>
@endsection

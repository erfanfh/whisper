@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="form-container">
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
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
                                    <div class="fw-bold">{{ $post->user->username }}</div>
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

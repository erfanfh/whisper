@extends('layouts.master')
@section('title', "Whisper! | " . $group->name )
@section('content')
    <nav style="z-index: 100" class="navbar bg-body-white border-bottom border-dark-subtle position-absolute top-0 end-0 w-75">
        <div class="container-fluid" style="z-index: 100">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#groupInfoModal">
                {{ $group->name }}
                <i class="fa fa-user-friends"></i>
                <i class="fa fa-chevron-right"></i>
            </button>
            <div style="z-index: 10" class="modal fade" id="groupInfoModal" tabindex="-1" aria-labelledby="groupInfoModalLabel" aria-hidden="true">
                <div style="z-index: 10" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="groupInfoModalLabel">Users </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="list-group gap-2">
                                @foreach($group->users as $user)
                                    @if(auth()->user()->contacts->where('belongs_id', $user->id)->first())
                                        <div class="list-item d-flex gap-2">
                                            <a href="{{ route('profile.show', ['username' => $user->username]) }}" class="list-group-item list-group-item-action d-flex align-items-center gap-1 ">
                                                <img width="25" src="{{ asset('Images/Profiles' . "/" . $user->profile->image) }}" alt="profile">
                                                {{ auth()->user()->contacts->where('belongs_id', $user->id)->first()->name }}
                                            </a>
                                            @if(!empty(auth()->user()->group->where('id', $group->id)->all()))
                                                <form action="{{ route('groups.remove', [$user->id, $group->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @else
                                        <div class="list-item d-flex gap-2">
                                            <a href="{{ route('profile.show', ['username' => $user->username]) }}" class="list-group-item list-group-item-action d-flex align-items-center gap-1 border-radius-2">
                                                <img width="25" src="{{ asset('Images/Profiles' . "/" . $user->profile->image) }}" alt="profile">
                                                {{ $user->name }}
                                            </a>
                                            @if(!empty(auth()->user()->group->where('id', $group->id)->all()))
                                                <form action="{{ route('groups.remove', [$user->id, $group->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @if(!empty(auth()->user()->group->where('id', $group->id)->all()))
                            <form action="{{ route('groupUser.update', $group) }}" method="post" class="modal-body">
                                @method('PUT')
                                @csrf
                                <select name="user" class="form-select mb-2" required>
                                    <option selected disabled>Select a user</option>
                                    @foreach(auth()->user()->contacts as $contact)
                                        @if(empty($group->users->where('id', $contact->belongs->id)->all()))
                                            <option value="{{ $contact->belongs->id }}">{{ $contact->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Add user</button>
                            </form>
                        @endif
                        <div class="modal-footer">
                            @if(!empty(auth()->user()->group->where('id', $group->id)->all()))
                                <form action="{{ route('groups.destroy', $group) }}" method="post" onsubmit="return confirm('Are you sure you want to delete the group?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete group</button>
                                </form>
                            @else
                                <form action="{{ route('groups.leave', $group) }}" method="post" onsubmit="return confirm('Are you sure you want to delete the group?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Leave group</button>
                                </form>
                            @endif
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
<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to submit the form?");
    }
</script>

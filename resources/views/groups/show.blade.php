@extends('layouts.master')
@section('title', "Whisper! | " . $group->name )
@section('content')
    <nav style="z-index: 100" class="navbar bg-white border-bottom border-dark-subtle position-sticky top-0 end-0">
        <div class="container-fluid" style="z-index: 100">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#groupInfoModal">
                {{ $group->name }}
                <i class="fa fa-user-friends"></i>
                <i class="fa fa-chevron-right"></i>
            </button>
            <div style="z-index: 10" class="modal fade" id="groupInfoModal" tabindex="-1"
                 aria-labelledby="groupInfoModalLabel" aria-hidden="true">
                <div style="z-index: 10" class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content group-user-modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="groupInfoModalLabel">Users </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="list-group gap-2">
                                @foreach($group->users as $user)
                                    @if(auth()->user()->contacts->where('belongs_id', $user->id)->first())
                                        <div class="list-item d-flex gap-2">
                                            <a href="{{ route('profile.show', ['username' => $user->username]) }}" class="list-group-item list-group-item-action d-flex align-items-center gap-1 rounded">
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
                                            <a href="{{ route('profile.show', ['username' => $user->username]) }}" class="list-group-item list-group-item-action d-flex align-items-center gap-1 rounded">
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
                            <form action="{{ route('groupName.update', $group) }}" method="post" class="modal-body">
                                @method('PUT')
                                @csrf
                                <input class="form-control mb-2" type="text" value="{{$group->name}}" name="name">
                                <button type="submit" class="btn btn-outline-primary" data-bs-dismiss="modal">Change group name</button>
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
                                <form action="{{ route('groups.leave', $group) }}" method="post"
                                      onsubmit="return confirm('Are you sure you want to delete the group?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Leave group
                                    </button>
                                </form>
                            @endif
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <livewire:post-whisper :group="$group"/>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <livewire:show-whispers :group="$group"/>
    </div>
@endsection

<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to submit the form?");
    }
</script>

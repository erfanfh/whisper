@extends('layouts.master')
@section('title', $user->username)
@section('content')
    <div>
        <div>
            <div class="background">
                <div class="bio-box pt-5 cover">
                    <div class="media align-items-end">
                        <div class="profile mr-3 d-flex flex-column">
                            <img src="{{ asset('Images/Profiles/' . $user->profile->image) }}" alt="Profile Photo"
                                 height="200" width="200" class="prof-img rounded-circle mb-4">
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="fs-1 mt-0 mb-0">
                                @if(empty(auth()->user()->contacts->where('belongs_id', $user->id)->all()))
                                    {{ $user->name }}
                                @else
                                    {{ auth()->user()->contacts->where('belongs_id', $user->id)->first()->name }}
                                @endif
                            </h4>
                            <p class="fs-6 data-info mb-4"><i class="fas fa-calendar-days mr-2"></i>
                                <span class="fw-lighter">Joined at </span>
                                <span class="fw-lighter">{{ $user->created_at->format('M Y') }}</span>
                            </p>
                            @auth()
                                @if(auth()->user()->followings()->first())
                                    @if(empty(auth()->user()->followings()->firstOrFail()->pivot->where('follower_id', $user->id)->where('following_id', auth()->user()->id)->get()->all()))
                                        @if(!(auth()->user()->username == $user->username))
                                            <form class="mb-3" method="post" action="{{ route('follow.user', $user) }}">
                                                @csrf
                                                @method('POST')
                                                <button class="btn btn-outline-light btn-sm btn-block" type="submit"
                                                        name="follow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-person-fill-add"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                                        <path
                                                            d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                                    </svg>
                                                    Follow
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        @if(!(auth()->user()->username == $user->username))
                                            <form class="mb-3" method="post"
                                                  action="{{ route('unfollow.user', $user) }}">
                                                @csrf
                                                @method('POST')
                                                <button class="btn btn-outline-light btn-sm btn-block" type="submit"
                                                        name="unfollow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-person-fill-dash"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                                        <path
                                                            d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                                    </svg>
                                                    Unfollow
                                                </button>
                                            </form>

                                        @endif
                                    @endif
                                @else
                                    @if(!(auth()->user()->username == $user->username))
                                        <form class="mb-3" method="post" action="{{ route('follow.user', $user) }}">
                                            @csrf
                                            @method('POST')
                                            <button class="btn btn-outline-light btn-sm btn-block" type="submit"
                                                    name="follow">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-person-fill-add"
                                                     viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                                    <path
                                                        d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                                                </svg>
                                                Follow
                                            </button>
                                        </form>

                                    @endif
                                @endif
                                @if(empty(auth()->user()->contacts->where('belongs_id', $user->id)->first()->name))
                                    @if(!(auth()->user()->username == $user->username))
                                        <a class="btn btn-outline-light btn-sm btn-block" data-bs-toggle="collapse"
                                           href="#collapseExample">
                                            <i class="fa fa-user"></i> Add contact
                                        </a>
                                        <div class="mt-2 collapse" id="collapseExample">
                                            <div class="card card-body bg-transparent">
                                                <form action="{{ route('contact.add', $user->username) }}"
                                                      method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                               value="{{ old('name') }}">
                                                    </div>
                                                    @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    @if(!(auth()->user()->username == $user->username))
                                        <a class="btn btn-outline-light btn-sm btn-block" data-bs-toggle="collapse"
                                           href="#collapseExample">
                                            <i class="fa fa-pen"></i> Edit contact
                                        </a>
                                        <div class="mt-2 collapse" id="collapseExample">
                                            <div class="card card-body bg-transparent">
                                                <form action="{{ route('contact.edit', $user->username) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                               value="{{ old('name') ? old('name') : auth()->user()->contacts->where('belongs_id', $user->id)->first()->name }}">
                                                    </div>
                                                    @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </form>
                                                <form class="mt-2"
                                                      action="{{ route('contact.delete', $user->username) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete contact</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if(auth()->user()->username == $user->username)
                                    <a class="btn btn-outline-light btn-sm btn-block" data-bs-toggle="collapse"
                                       href="#collapseExample">
                                        <i class="fa fa-pen"></i> Edit profile
                                    </a>
                                    <div class="mt-2 collapse" id="collapseExample">
                                        <div class="card card-body bg-transparent">
                                            <form action="{{ route('profile.post') }}" method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label">Profile Photo</label>
                                                    <input class="form-control" type="file" name="profile">
                                                    <div class="form-text text-danger">
                                                        @error('profile')
                                                        {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="name"
                                                           value="{{ old('name') ? old('name') : auth()->user()->name }}"
                                                           class="form-control">
                                                    <div class="form-text text-danger">
                                                        @error('name')
                                                        {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text">https://epicmaze.ir/</span>
                                                        <input name="username" type="text" class="form-control"
                                                               placeholder="Username"
                                                               value="{{ old('username') ? old('username') : auth()->user()->username }}">
                                                    </div>
                                                    <div class="form-text text-danger">
                                                        @error('username')
                                                        {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bio <span
                                                            class="small">(Max: 1000 chars)</span></label>
                                                    <textarea rows="10" class="form-control"
                                                              name="bio">{{ old('email') ? old('email') : auth()->user()->profile->bio }}</textarea>
                                                    <div class="form-text text-danger">
                                                        @error('bio')
                                                        {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email"
                                                           value="{{ old('email') ? old('email') : auth()->user()->email }}"
                                                           class="form-control">
                                                    <div class="form-text text-danger">
                                                        @error('email')
                                                        {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-secondary">Update</button>
                                            </form>
                                            <form class="mt-2" action="{{ route('profile.delete') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete profile photo
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="mt-3 alert alert-success">{{session('success')}}</div>
                                @endif
                                <div class="mt-3 d-flex gap-3">
                                    <button type="button" class="btn text-light" data-bs-toggle="modal"
                                            data-bs-target="#followersModal">
                                        Followers: {{ $user->followers ? $user->followers->count() : 0 }}
                                    </button>
                                    <button type="button" class="btn text-light" data-bs-toggle="modal"
                                            data-bs-target="#followingsModal">
                                        Following: {{ $user->followings ? $user->followings->count() : 0 }}
                                    </button>
                                </div>
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
                    <div style="white-space: pre-line;" class="rounded shadow-sm bg-light bio-box">
                        {{ $user->profile->bio }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    Followers Modal--}}
    <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="followersModalLabel">{{ $user->name }}'s followers</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group gap-2">
                        @foreach($user->followers as $follower)
                            <div class="list-item d-flex gap-2">
                                <a href="{{ route('profile.show', ['username' => $follower->username]) }}"
                                   class="list-group-item list-group-item-action d-flex align-items-center gap-1 rounded">
                                    <img width="25"
                                         src="{{ asset('Images/Profiles' . "/" . $follower->profile->image) }}"
                                         alt="profile">
                                    {{ $follower->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    Followings Modal--}}
    <div class="modal fade" id="followingsModal" tabindex="-1" aria-labelledby="followingsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="followingsModalLabel">{{ $user->name }}'s followings</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group gap-2">
                        @foreach($user->followings as $following)
                            <div class="list-item d-flex gap-2">
                                <a href="{{ route('profile.show', ['username' => $following->username]) }}"
                                   class="list-group-item list-group-item-action d-flex align-items-center gap-1 rounded">
                                    <img width="25"
                                         src="{{ asset('Images/Profiles' . "/" . $following->profile->image) }}"
                                         alt="profile">
                                    {{ $following->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

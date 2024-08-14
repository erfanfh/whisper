@include('layouts.header')
@include('layouts.sidebar')
<div class="position-absolute end-0 top-0 w-75">
    <div>
        <div class="background">
            <div class="bio-box pt-5 cover">
                <div class="media align-items-end">
                    <div class="profile mr-3 d-flex flex-column">
                        <img src="{{ asset('/Images/Profiles/' . $user->profile->image) }}" alt="Profile Photo" height="200" width="200" class="prof-img rounded-circle mb-4">
                    </div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="fs-1 mt-0 mb-0">
                            @if(empty(auth()->user()->contacts->where('belongs_id', $user->id)->all()))
                                {{ $user->name }}
                            @else
                                {{ auth()->user()->contacts->where('belongs_id', $user->id)->first()->name }}
                            @endif
                        </h4>
                        <p class="fs-6 data-info mb-4"> <i class="fas fa-calendar-days mr-2"></i>
                            <span class="fw-lighter">Joined at </span>
                            <span class="fw-lighter">{{ $user->created_at->format('M Y') }}</span>
                        </p>
                        @auth()
                            @if(empty(auth()->user()->contacts->where('belongs_id', $user->id)->first()->name))
                                @if(!(auth()->user()->username == $user->username))
                                    <a class="btn btn-outline-light btn-sm btn-block" data-bs-toggle="collapse" href="#collapseExample">
                                        <i class="fa fa-user"></i> Add contact
                                    </a>
                                    <div class="mt-2 collapse" id="collapseExample">
                                        <div class="card card-body bg-transparent">
                                            <form action="{{ route('contact.add', $user->username) }}" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
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
                                    <a class="btn btn-outline-light btn-sm btn-block" data-bs-toggle="collapse" href="#collapseExample">
                                        <i class="fa fa-pen"></i> Edit contact
                                    </a>
                                    <div class="mt-2 collapse" id="collapseExample">
                                        <div class="card card-body bg-transparent">
                                            <form action="{{ route('contact.edit', $user->username) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : auth()->user()->contacts->where('belongs_id', $user->id)->first()->name }}">
                                                </div>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <button type="submit" class="btn btn-primary">Edit</button>
                                            </form>
                                            <form class="mt-2" action="{{ route('contact.delete', $user->username) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete contact</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if(auth()->user()->username == $user->username)
                                    <a class="btn btn-outline-light btn-sm btn-block" data-bs-toggle="collapse" href="#collapseExample">
                                        <i class="fa fa-pen"></i> Edit profile
                                    </a>
                                    <div class="mt-2 collapse" id="collapseExample">
                                        <div class="card card-body bg-transparent">
                                            <form action="{{ route('profile.post') }}" method="POST" enctype="multipart/form-data">
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
                                                    <input type="text" name="name" value="{{ old('name') ? old('name') : auth()->user()->name }}" class="form-control">
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
                                                        <input name="username" type="text" class="form-control" placeholder="Username" value="{{ old('username') ? old('username') : auth()->user()->username }}">
                                                    </div>
                                                    <div class="form-text text-danger">
                                                        @error('username')
                                                        {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bio <span class="small">(Max: 1000 chars)</span></label>
                                                    <textarea rows="10" class="form-control" name="bio">{{ old('email') ? old('email') : auth()->user()->profile->bio }}</textarea>
                                                    <div class="form-text text-danger">
                                                        @error('bio')
                                                        {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" value="{{ old('email') ? old('email') : auth()->user()->email }}" class="form-control">
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
                                                <button type="submit" class="btn btn-danger">Delete profile photo </button>
                                            </form>
                                        </div>
                                    </div>
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

@include('layouts.footer')

@extends('layouts.master')

@section('content')
    <div class="col-12 col-md-6">
        <div class="card">
            <h5 class="card-header">Profile</h5>
            <div class="card-body">
                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="delete-profile" id="delete-profile">
                        <label style="color: #c13838" class="form-check-label pb-2" for="delete-profile">
                            Delete profile picture
                        </label>
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
                        <input type="text" name="username" value="{{ old('username') ? old('username') : auth()->user()->username }}" class="form-control">
                        <div class="form-text text-danger">
                            @error('username')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bio <span class="small">(Max: 1000 chars)</span></label>
                        <textarea class="form-control" name="bio">{{ old('email') ? old('email') : auth()->user()->profile->bio }}</textarea>
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
                    <a class="btn btn-secondary" href="{{ route('profile.show', auth()->user()->username) }}">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection

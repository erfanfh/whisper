@extends('auth.master')
@section('title', 'Signup to Whisper!')
@section('content')
    <div class="card">
        <h5 class="card-header">Register</h5>
        <div class="card-body">
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    <div class="form-text text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text">@</span>
                        <input name="username" type="text" class="form-control" placeholder="Username"
                               value="{{ old('username') }}">
                    </div>
                    <div class="form-text text-danger">
                        @error('username')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                    <div class="form-text text-danger">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <div class="form-text text-danger">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    <div class="form-text text-danger">
                        @error('password_confirmation')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>
@endsection

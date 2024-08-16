@extends('auth.master')
@section('title', 'Login to Whisper!')
@section('content')
    <div class="card">
        <h5 class="card-header">Login</h5>
        <div class="card-body">
            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email or Username</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
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
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>
@endsection

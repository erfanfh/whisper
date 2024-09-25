@extends('auth.master')
@section('title', 'Signup to Whisper!')
@section('content')
    <div class="card">
        <h5 class="card-header">Register</h5>
        <div class="card-body">
            <livewire:auth.register/>
        </div>
    </div>
@endsection

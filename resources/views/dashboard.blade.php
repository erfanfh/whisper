@extends('layouts.master')
@section('title', 'Whisper!')
@section('content')
    <div class="container ">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endsection

@extends('layouts.master')
@section('title', 'Contacts')
@section('content')
    <div class="container">
        <div class="fs-1 fw-bold">
            Contacts
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <hr>
        @if(empty($contacts->all()))
            <div class="fs-5 fw-light">
                You have no contact yet!
            </div>
        @endif
        @foreach($contacts as $contact)
            <div class="d-flex flex-column p-4 my-3 post-sec">
                <div class="d-flex justify-content-between align-items-center mb-10">
                    <div class="d-flex gap-3">
                        <a href="{{ route('profile.show', $contact->belongs->username) }}">
                            <img alt="Profile" class="post-user-prof rounded-circle"
                                 src="{{ asset('Images/Profiles/' . $contact->belongs->profile->image) }}">
                        </a>
                        <div style="grid-gap: 5px" class="d-flex">
                            <div class="d-flex align-items-center mb-10 sender">
                                <a style="color: black" href="{{ route('profile.show', $contact->belongs->username) }}">
                                    <div class="fw-bold">
                                        {{ $contact->name }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

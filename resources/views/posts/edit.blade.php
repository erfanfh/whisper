@extends('layouts.master')
@section('title', 'Whisper! | Edit')
@section('content')
    <div class="container">
        <div class="form-container">
            <form action="{{ route('posts.update', $post) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <textarea name="message" class="mb-4 form-control" rows="5">{{ $post->message }}</textarea>
                </div>
                <div class="edit-buttons">
                    <button type="submit">Edit</button>
                    <a style="background-color: gray" href="{{ route('dashboard') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

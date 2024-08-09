@extends('errors.master')

@section('code')
    <h1>404</h1>
@endsection

@section('error')
    <p>Sorry, the page you're looking for cannot be found.</p>
@endsection

@section('action')
    <p><a href="{{ url('/') }}">Return to Homepage</a></p>
@endsection

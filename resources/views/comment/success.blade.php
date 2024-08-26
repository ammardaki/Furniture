@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Comment Successful</h1>
    <p>Your booking has been successfully created.</p>
    <a href="{{ route('comment.index') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection
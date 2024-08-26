@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="alert alert-success">
        Booking deleted successfully.
    </div>
    <a href="{{ route('home') }}" class="btn btn-primary">Back to Bookings</a>
</div>
@endsection

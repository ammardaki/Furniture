@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booking Furniture</h1>
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="furniture_id">Furniture ID</label>
            <input type="number" id="furniture_id" name="furniture_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="number" id="user_id" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="time">Time</label>
            <input type="text" id="time" name="time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>
@endsection

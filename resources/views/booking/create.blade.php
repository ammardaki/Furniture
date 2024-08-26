@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Booking Furniture</h1>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="furniture_id">Furniture ID</label>
                    <input type="number" id="furniture_id" name="furniture_id" class="form-control" value="{{ $furniture_id }}" readonly required>
                </div>
                <div class="form-group mt-3">
                    <label for="furniture_name">Furniture Name</label>
                    <input type="text" id="furniture_name" name="furniture_name" class="form-control" value="{{ $furniture_name }}" readonly required>
                </div>
                <div class="form-group mt-3">
                    <label for="user_id">User ID</label>
                    <input type="number" id="user_id" name="user_id" class="form-control" value="{{ $user_id }}" readonly required>
                </div>
                <div class="form-group mt-3">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $quantity }}" required>
                </div>
                <div class="form-group mt-3">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="form-group mt-3">
                    <label for="time">Time</label>
                    <input type="text" id="time" name="time" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Book Now</button>
            </form>
        </div>
        <div class="col-md-4 text-center">
            <img src="{{ asset('chair.png') }}" alt="Furniture Image" class="img-fluid mt-4 custom-image">
        </div>
    </div>
</div>
@endsection

<style>
    .custom-image {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }
</style>

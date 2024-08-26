@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1>Bookings</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Time</th>
              
            </tr>
        </thead>
        <tbody>
        
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user_id }}</td>
                    <td>{{ $booking->quantity }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->time }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

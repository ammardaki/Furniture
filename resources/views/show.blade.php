@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white text-center py-1">
                    <h3 class="card-title m-0">Furniture Details</h3>
                </div>
                <div class="card-body py-1">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img src="{{ $furniture->img_url }}" alt="Furniture Image" class="furniture-image mb-2">
                        </div>
                        <div class="col-md-6">
                            <div class="textstyle">
                                <h5 class="mb-1"><strong>ID:</strong> {{ $furniture->id }}</h5>
                                <h5 class="mb-1"><strong>Name:</strong> {{ $furniture->furniture_name }}</h5>
                                <h5 class="mb-1"><strong>Quantity:</strong> {{ $furniture->quantity }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center py-1">
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('booking.form') }}" method="GET" class="me-2">
                            @csrf
                            <input type="hidden" name="furniture_id" value="{{ $furniture->id }}">
                            <input type="hidden" name="furniture_name" value="{{ $furniture->furniture_name }}">
                            <input type="hidden" name="quantity" value="{{ $furniture->quantity }}">
                            <button type="submit" class="btn btn-primary btn-lg btn-custom">Book Now</button>
                        </form>
                        <form action="{{  route('bookings.index')  }}"class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg btn-custom">My Books</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .furniture-image {
        width: 100%;
        height: auto;
    }

    .textstyle {
        text-align: center;
    }

    .card-body {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .card-footer {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .btn {
        min-width: 150px;
        margin: 5px;
    }

    .btn-custom {
        padding: 8px 16px;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }
</style>

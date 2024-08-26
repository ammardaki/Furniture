@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Furniture List</h1>
    <div class="row">
        @foreach ($furniture as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $item->img_url }}" alt="Furniture Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->furniture_name }}</h5>
                        <p class="card-text">Quantity: {{ $item->quantity }}</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2>Ads</h2>
    <div class="row">
        @foreach ($ads as $ad)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $ad->image_url }}" alt="Ad Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $ad->title }}</h5>
                        <p class="card-text">{{ $ad->description }}</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

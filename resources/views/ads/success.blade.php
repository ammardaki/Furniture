<!-- resources/views/ads/confirmation.blade.php -->
@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="css/adsuccess.css">

<div class="container page" id="confirmationPage">
    <div class="card custom-card">
        <div class="card-body text-center">
            <h2 class="card-title">Advertisement Added Successfully!</h2>
            <p>Your new advertisement has been added successfully.</p>
            <p class="mt-3">You can view all your advertisements by clicking the button below.</p>
            <a href="{{ route('ads.index') }}" class="btn btn-primary">View Advertisements</a>
            <a href="{{ route('homeadmin') }}" class="btn btn-secondary mt-2">Go to Home</a>
        </div>
    </div>
</div>
@endsection

@section('styles')
@endsection

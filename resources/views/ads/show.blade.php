@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="css/showadd.css">

    <style>
           </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img class="card-img-top" src="{{ $ad->image_url }}" alt="Ad Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $ad->title }}</h5>
                        <p class="card-text">{{ $ad->description }}</p>
                        <!-- Add a JavaScript function to handle the back navigation -->
                        <a href="javascript:history.back()" class="btn btn-secondary">العودة</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

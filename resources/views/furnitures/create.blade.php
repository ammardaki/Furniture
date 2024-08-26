<!-- صفحة التأكيد بعد إضافة الأثاث بنجاح -->
@extends('layouts.app')
@section('content')
<div class="container page" id="confirmationPage">
    <div class="card custom-card">
        <div class="card-body text-center">
            <h2 class="card-title">Furniture Added Successfully!</h2>
            <p>Your new furniture has been added successfully.</p>
            <a href="{{ route('homeadmin') }}" class="btn btn-primary">Go to Home</a>
        </div>
    </div>
</div>
@endsection


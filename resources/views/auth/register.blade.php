
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #b66434;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            height: 150vh; /* تعيين الارتفاع ليملء الشاشة بالكامل */
        }

        .register-form {
            margin: 9;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* زيادة التباعد الداخلي */
            width: 1000px; /* زيادة العرض */
            max-width: 90%; /* تحديد العرض الأقصى */
        }

        .register-form h1 {
            text-align: center;
            margin-bottom: 30px; /* زيادة التباعد بين العناصر */
        }

        .register-form .main {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .register-form .form-img img {
            width: 350px; /* تحديد العرض */
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .register-form .content {
            flex: 1;
            padding: 15px;
            max-width: 1100px;
            margin: 0 auto;


        }

        .register-form h2 {
            margin-bottom: 10px;
            color: #333;
        }

        .register-form label {
            font-weight: bold;
            color: #555;
            margin-bottom: 8;
            display: block;
        }

        .register-form input[type="email"],
        .register-form input[type="password"],
        .register-form input[type="text"],
        .register-form select {
            width: calc(100% - 15px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .register-form button[type="submit"] {
            background-color: #b66434;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        .register-form .btn-link {
            text-decoration: none;
            color: #007bff; /* تغيير لون الرابط */
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        .register-form .btn-link:hover {
            color: #0056b3; /* تغيير لون الرابط عند التحويم */
        }

        .register-form .content > div {
            margin-bottom: 20px; /* تغيير الهامش بين العناصر */
        }
    </style>
</head>
<body>
<div class="register-form">
    {{-- <h1>Register</h1> --}}
    <div class="main">
        <div class="form-img">
            <img src="bg.png" alt="Background">
        </div>
        <div class="content">
            <h2>Sign Up</h2>
        
            <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="row mb-3">
        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>

    <div class="mb-3">
        <label for="phone">Phone Number</label>
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="role_id">Role</label>
        <input id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id" value="{{ old('role_id') }}" required autocomplete="role_id" autofocus>
        @error('role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </div>
    @if (Route::has('login'))
        <a class="btn-link" href="{{ route('login') }}">Already have an account? Login</a>
    @endif
</form>

        </div>
    </div>
</div>
</body>
</html>

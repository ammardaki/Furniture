<!DOCTYPE html>
<html>

<head>
    <title>Portfolio Website</title>
    <link rel="stylesheet" type="text/css" href="welcome style.css">
</head>

<body>
    <div class="header">
        <a class="btn-login" href="{{ route('login') }}">Login</a>
        <a class="btn-register" href="{{ route('register') }}">Register</a>


    </div>
    <div class="container">
        <div class="text">
            <img src="b1.png" alt="Aldaki Furniture" class="logo">

            <h1>Aldaki Furniture</h1>
            <p>Perfect furniture that will transform your home into a stylish and comfortable Shop now!.</p>
        </div>
        <div class="image">
            <img src="welcome.png" alt="Aldaki Furniture">
        </div>
    </div>
</body>

</html>

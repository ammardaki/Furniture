{{-- <!-- resources/views/reservations/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create Reservation</title>
</head>
<body>
    <h1>Create Reservation</h1>
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <label for="furniture_id">Furniture ID:</label>
        <input type="text" id="furniture_id" name="furniture_id" required>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html> --}}
<!-- resources/views/reservations/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Create Reservation</title>
</head>
<body>
    <h1>Create a Reservation</h1>

    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <div>
            <label for="furniture_id">Furniture ID:</label>
            <input type="number" id="furniture_id" name="furniture_id" value="{{ old('furniture_id') }}" required>
            @error('furniture_id')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" required>
            @error('quantity')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="{{ old('date') }}" required>
            @error('date')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" value="{{ old('time') }}" required>
            @error('time')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Create Reservation</button>
    </form>
</body>
</html>

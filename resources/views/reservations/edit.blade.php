<!-- resources/views/reservations/edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Reservation</title>
</head>
<body>
    <h1>Edit Reservation</h1>
    <form action="{{ route('web.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="furniture_id">Furniture ID:</label>
        <input type="text" id="furniture_id" name="furniture_id" value="{{ $reservation->furniture_id }}" required>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="{{ $reservation->quantity }}" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="{{ $reservation->date }}" required>
        <br>
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" value="{{ $reservation->time }}" required>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

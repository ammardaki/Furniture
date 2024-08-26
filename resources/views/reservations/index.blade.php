<!-- resources/views/reservations/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Reservations</title>
</head>
<body>
    <h1>Reservations</h1>

    <a href="{{ route('reservations.create') }}">Create Reservation</a>

    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Furniture ID</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->furniture_id }}</td>
                    <td>{{ $reservation->quantity }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation->id) }}">View</a>
                        <a href="{{ route('reservations.edit', $reservation->id) }}">Edit</a>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!-- resources/views/allfurniture.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Furniture</title>
</head>
<body>
    <h1>All Furniture</h1>
    
    @if (isset($data) && count($data) > 0)
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
            </tr>
            @foreach ($data as $furniture)
                <tr>
                    <td>{{ $furniture->id }}</td>
                    <td>{{ $furniture->furniture_name }}</td>
                    <td>{{ $furniture->quantity }}</td>
                </tr>
            {{-- @endforeach --}}
        </table>
    {{-- @else --}}
        <p>No furniture available.</p>
    {{-- @endif --}}
</body>
</html>

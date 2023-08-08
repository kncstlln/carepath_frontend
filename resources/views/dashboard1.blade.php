<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>User Dashboard</h1>

<table border="1">
    <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Username</th>
        <th>Barangay</th>
        <th>User Type</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user['name'] }}</td>
        <td>{{ $user['username'] }}</td>
        <td>{{ $user['barangay']['name'] }}</td>
        <td>{{ $user['user_type'] }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>

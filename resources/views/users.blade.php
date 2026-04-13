<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f4f4f4; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background: #007bff; color: white; }
        select, button { padding: 5px; }
        .success { color: green; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Manage Users</h2>

@if(session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>

        <td>
            <form action="/admin/users/update-role/{{ $user->id }}" method="POST">
                @csrf
                <select name="role">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
        </td>

        <td>
                <button type="submit">Update</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>
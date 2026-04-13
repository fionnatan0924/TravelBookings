<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        input, select {
            padding: 5px;
        }

        button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add { background: green; color: white; }
        .update { background: orange; color: white; }
        .delete { background: red; color: white; }

    </style>
</head>
<body>

<div class="container">

    <h2 style="text-align:center;">Admin - Manage Users</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <!-- ADD USER -->
    <h3>Add User</h3>
    <form method="POST" action="/admin/users/add">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="password" placeholder="Password" required>

        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button class="add">Add</button>
    </form>

    <!-- USERS TABLE -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <form method="POST" action="/admin/users/update/{{ $user->id }}">
                @csrf

                <td>{{ $user->id }}</td>

                <td>
                    <input type="text" name="name" value="{{ $user->name }}">
                </td>

                <td>
                    <input type="email" name="email" value="{{ $user->email }}">
                </td>

                <td>
                    <select name="role">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </td>

                <td>
                    <button class="update">Update</button>
                    <a href="/admin/users/delete/{{ $user->id }}">
                        <button type="button" class="delete">Delete</button>
                    </a>
                </td>
            </form>
        </tr>
        @endforeach

    </table>

</div>

</body>
</html>
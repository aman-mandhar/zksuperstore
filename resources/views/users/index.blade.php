<!-- resources/views/users/index.blade.php -->

@extends('layouts.admin') <!-- Extend the layout if you have one -->

@section('content')
    <h1>User Table Data</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Referral Mobile Number</th>
                <th>User Role</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Action</th>
                <th>destroy</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->mobile_number }}</td>
                    <td>{{ $user->ref_mobile_number }}</td>
                    <td>{{ $user->user_role }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}">View</a>
                        <a href="{{ route('users.role', $user->id) }}">Change Role</a>
                        <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

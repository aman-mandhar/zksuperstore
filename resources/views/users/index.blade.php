<!-- resources/views/users/index.blade.php -->

@extends('layouts.app') <!-- Extend the layout if you have one -->

@section('content')
    <h1>User Table Data</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Referral Mobile Number</th>
                <th>User Role</th>
                <th>Email</th>
                <th>Email Verified At</th>
                <th>Password</th>
                <!-- Add more table headers for other user columns as needed -->
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->mobile_number }}</td>
                    <td>{{ $user->ref_mobile_number }}</td>
                    <td>{{ $user->user_role }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    <td>{{ $user->password }}</td>
                    <!-- Add more table cells for other user columns as needed -->
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

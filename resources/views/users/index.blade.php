<!-- resources/views/users/index.blade.php -->

@extends('layouts.admin') <!-- Extend the layout if you have one -->

@section('content')
    <h1>User Table Data</h1>

    <table>
        <thead>
            <tr>
                <th class="col-md-2">Name</th>
                <th class="col-md-2">Mobile Number</th>
                <th class="col-md-2">Referral Mobile Number</th>
                <th class="col-md-2">User Role</th>
                <th class="col-md-2">Email</th>
                <th class="col-md-2">Created At</th>
                <th class="col-md-2">Action</th>
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
                        <a href="{{ route('users.roles', $user->id) }}">Change Role</a>
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
    <table>
        <thead>
            <tr>
                <th>User Role & Name</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0</td>
                <td>Customer</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Admin</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Store</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Warehouse</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Sub-Warehouse</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Employee</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Merchant</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Transporter</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Delivery Partner</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Business Promoter</td>
            </tr>
        </tbody>
    </table>
@endsection

                        

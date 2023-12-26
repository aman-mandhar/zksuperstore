@extends('layouts.admin')

@section('content')
    <div class="container col-md-6">
        <h4>User Details</h4>
        <hr>
        <table
            class="table table-striped table-bordered table-hover table-condensed">
            <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Mobile Number</td>
                <td>{{ $user->mobile_number }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Referral Mobile Number</td>
                <td>{{ $user->ref_mobile_number }}</td>
            </tr>
            <tr>
                <td>Referral Name</td>
                <td> @if($Refname->isNotEmpty())
                    <p>{{ $Refname->first()->name }}</p>
                    @else
                    <p>Referral Name not found</p>
                    @endif
                </td>
            </tr>
            <tr>
                <td>User Role</td>
                <td>{{ $user->user_role }}</td>
            </tr>
            <tr>
                <td>With us from</td>
                <td>{{ $user->created_at }}</td>
            </tr>
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
    </div>
@endsection
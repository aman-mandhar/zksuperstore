@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Search User by Mobile Number</h2>
    <p>Enter the mobile number of the user to search for.</p>
    <form action="{{ route('sales.bill') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" value="{{ request('mobile_number') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Mobile Number</th>
                        <th>Name</th>
                        <th>Referral</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="user-row">
                        <td>{{ $user->mobile_number }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->referral }}</td>
                        <td>
                            <a href="{{ route('sales.bill', $user->id) }}" class="btn btn-warning">Sale</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No users found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('mobile_number').addEventListener('input', function () {
        var searchValue = this.value.toLowerCase();

        // Loop through each row in the table body
        document.querySelectorAll('.user-row').forEach(function (row) {
            var mobileNumber = row.querySelector('td:first-child').textContent.toLowerCase();
            row.style.display = mobileNumber.includes(searchValue) ? 'table-row' : 'none';
        });
    });
</script>

@endsection

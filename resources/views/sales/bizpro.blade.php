@extends('layouts.app')

@section('content')
<div class="col-md-6">


<form class = "col-md-6" action="{{ route('sales.bizpro') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Customer Mobile Number" name="search" id="search" value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-secondary">Search</button>
    </div>
</form>
</div>
<div class="col-md-6">
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Referral</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($users->isEmpty())
            <p>No users found. <a href="{{ route('users.create') }}">Create a new user</a></p>
        @else
    <!-- Display the user information and the bill creation form -->
        @endif
        @forelse($users as $user)
            <tr class = "item-row">
            <td>{{ $user->name }}</td>
            <td>{{ $user->mobile_number }}</td>
            <td>{{ $user->ref_mobile_number }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4"><p>No users found. <a href="{{ route('users.create') }}">Create a new user</a></p></td>
        </tr>
    @endforelse
    </tbody>
</table>
</div>
<div class="col-md-6">
    <!-- Bill creation form -->
    <form action="{{ route('sales.kit') }}" method="POST">
        @csrf
        <!-- Include fields for the bill, such as items, quantities, etc. -->
        <!-- Submit button to create the bill -->
        <button type="submit" class="btn btn-primary">Create Bill</button><p>No users found. <a href="{{ route('users.create') }}">Create a new user</a></p>
    </form>
</div>

<script>
    document.getElementById('search').addEventListener('input', function () {
    var searchValue = this.value;

    // Loop through each row in the table body
    document.querySelectorAll('.item-row').forEach(function (row) {
        var mobileNumber = row.querySelector('td:nth-child(2)').textContent;
        row.style.display = mobileNumber.includes(searchValue) ? 'table-row' : 'none';
    });
});

</script>
@endsection
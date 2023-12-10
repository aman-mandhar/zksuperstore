@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Search Form --}}
        <form action="{{ route('stocks.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name" name="search" id="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>

        <h2>Stocks</h2>

        {{-- Display Items --}}
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Sale Price</th>
                    <th>Points</th>
                    <th>Total Stock Value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $stock)
                    <tr class="item-row">
                        <td>
                            <img src="{{ asset($stock->prod_pic) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>{{ $stock->name }}</td>
                        <td>{{ $stock->sale_price }}</td>
                        <td>{{ 0.25 * $stock->tot_points }}</td>
                        <td>
                            <a href="{{ route('stocks.bill', $stock->id) }}" class="btn btn-warning">Sale</a>
                            <a href="{{ route('stocks.transfer', $stock->id) }}" class="btn btn-warning">Required</a>
                            <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <!-- Handle the case where there are no stocks -->
                    <tr>
                        <td colspan="9">No stocks found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Add Item Button --}}
        <a href="{{ route('items.create') }}" class="btn btn-success">Add Item</a>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function () {
            var searchValue = this.value.toLowerCase();

            // Loop through each row in the table body
            document.querySelectorAll('.item-row').forEach(function (row) {
                var itemName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                row.style.display = itemName.includes(searchValue) ? 'table-row' : 'none';
            });
        });
    </script>
@endsection

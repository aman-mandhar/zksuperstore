@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- Search Form --}}
        <form action="{{ route('items.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name" name="search" id="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>

        <h2>Items</h2>

        {{-- Display Items --}}
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr class="item-row">
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->type }}</td>
                        <td>
                            <img src="{{ asset($item->prod_pic) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">
                        </td>

                        <td>
                            <a href="{{ route('stocks.add', $item->id) }}" class="btn btn-warning">Add Stock</a>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No items found</td>
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
                var itemName = row.querySelector('td:first-child').textContent.toLowerCase();
                row.style.display = itemName.includes(searchValue) ? 'table-row' : 'none';
            });
        });
    </script>
@endsection

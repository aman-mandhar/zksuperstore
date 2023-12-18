@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- Search Form --}}
        <form action="{{ route('stocks.services') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name" name="search" id="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>

        <h2>Services</h2>

        {{-- Display Items --}}
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Sale Price</th>
                    <th>Points</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stocks as $stock)
                    @if ($stock->item && $stock->item->prod_cat != 'Services')
                    <tr class="item-row">
                        <td>
                            @php
                                $img = $stock->item->prod_pic; // Assuming there is a relationship between Stock and Item
                            @endphp
                                <img src="{{ asset($img) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">

                        </td>
                        <td>
                            @php
                                $name = $stock->item->name; // Assuming there is a relationship between Stock and Item
                                $description = $stock->item->description; // Assuming there is a relationship between Stock and Item
                            @endphp
                            {{ $name }}
                            <br>
                            <small>{{ $description }}</small>
                        </td>
                        <td>{{ $stock->sale_price }}</td>
                        @if ($user->user_role == 2)
                            <td>{{ 0.50 * $stock->tot_points }}</td>
                        @elseif ($user->user_role == 4)
                            <td>{{ 0.25 * $stock->tot_points }}</td>
                        @else
                            <td>
                                0
                            </td>                    
                        @endif
                        <td>
                            <a href="{{ route('stocks.bill', $stock->id) }}" class="btn btn-warning">Sale</a>
                            @if ($user->user_role == 2)
                            <a href="{{ route('stocks.transfer', $stock->id) }}" class="btn btn-warning">Required</a>
                            @elseif ($user->user_role == 3)
                            <a href="{{ route('stocks.transfer', $stock->id) }}" class="btn btn-warning">Add Stock</a>
                            @elseif ($user->user_role == 4)
                            <a href="{{ route('stocks.transfer', $stock->id) }}" class="btn btn-warning">Required</a>
                            @else
                            <a href="{{ route('stocks.add', $stock->id) }}" class="btn btn-warning">Add Stock</a>
                            @endif
                            <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endif
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

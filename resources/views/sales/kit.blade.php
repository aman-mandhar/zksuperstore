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
                        <td>{{ $stock->tot_points }}</td>
                        <td>
                            <a href="{{ route('sales.bill', $stock->id) }}" class="btn btn-warning">Sale</a>
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

@extends('layouts.admin')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Sale Price</th>
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
                <td>
                    <a href="{{ route('sales.bill', $stock->id, $user->id) }}" class="btn btn-warning">Sale</a>
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
@endsection
<!-- resources/views/stocks/create.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Stock Requirement</h2><br>
        <p><i>Per Item List</i></p>
        {{-- Search Form --}}
        <form action="{{ route('items.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name or category" name="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>       
        
        {{-- Display Items 
        <form action="{{ route('saveRequirements') }}" method="post">
            @csrf--}}
        <table class="table">
            <thead>
                <tr>
                    <th>Your user ID</th>
                    <th>Stock ID</th>
                    <th>Item Name</th>
                    <th>Sale Peice<br><i>per item/kg</i></th>
                    <th>points on Sale</th>
                    <th>Total<br>In Items</th>
                    <th>In Kilos</th>
                    <th>Requirement</th>
                    

                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
            <tr>
            <td><input type="text" name="user_id" value="{{ auth()->id() }}" readonly></td>
            <td><input type="text" name="stock_id" value="{{ $stock->id }}" readonly></td>
            <td><input type="text" name="item_name" value="{{ $stock->name }}" readonly></td>
            <td><input type="text" name="sale_price" value="{{ $stock->sale_price }}" readonly></td>
            <td><input type="text" name="points" value="{{ $stock->tot_points }}" readonly></td>
            <td>{{ $stock->tot_no_of_items }}</td>
            <td>{{ $stock->measure }}</td>
            <td><input type="number" name="items_required" id="items_required" class="form-control"></td>
        </tr>
  @endforeach
           </tbody>
        </table>
        <button type="submit" class="btn btn-success">Save Requirements</button>
    <!--</form>-->
    </div>
@endsection




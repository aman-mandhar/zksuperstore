@extends('layouts.app')

@section('content')

    <div class="container col-md-6">
        <h2>Stock Transfer</h2>
        <span>for</span>
        <table class="table col-md-6">
            <tbody>
                <tr>
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
                            $prod_cat = $stock->item->prod_cat; // Assuming there is a relationship between Stock and Item
                        @endphp
                        {{ $name }}
                        <br>
                        <small>{{ $description }}</small>
                        <br>
                        <small>{{ $prod_cat }}</small>
                    </td>
                </tr>
            </tbody>
        </table>
        <form action="{{ route('transfers.index') }}" method="POST" class="col-md-6">
            @csrf
            <div class="form-group">
                <label for="sale_price">Sale Price:</label>
                <input type="number" name="sale_price" id="sale_price" class="form-control" placeholder="Sale Price" value="{{ $stock->sale_price }}" readonly>
            </div>

            <!-- Add other fields as needed -->
            @php
                $type = $stock->item->type; // Assuming there is a relationship between Stock and Item
            @endphp
            @if ($type === "Loose")                        
                <div class="form-group">
                    <label for="measure">Weight:</label>
                    <input type="number" name="measure" id="measure" class="form-control" placeholder="Weight" oninput="updateMeasureTotal()">
                    <div class="form-group">
                        <label for="total_amount_measure">Total Amount (Measure):</label>
                        <input type="number" name="total_amount_measure" id="total_amount_measure" placeholder="0" readonly>
                    </div>
                </div>
            @else
                <div class="form-group">
                    <label for="tot_no_of_items">Number of Items:</label>
                    <input type="number" name="tot_no_of_items" id="tot_no_of_items" class="form-control" placeholder="Number of Items" oninput="updateTotNoOfItemsTotal()">
                    <div class="form-group">
                        <label for="total_amount_tot_no_of_items">Total Amount (Tot No. of Items):</label>
                        <input type="number" name="total_amount_tot_no_of_items" id="total_amount_tot_no_of_items" placeholder="0" readonly>
                    </div>
                </div>
            @endif
        
            <!-- Add more fields based on your requirements -->
            <input type="hidden" name="stock_id" value="{{ $stock->id }}">
            <input type="hidden" name="item_id" value="{{ $stock->item->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    
            <button type="submit" class="btn btn-primary">Add Stock</button>
        </form>
        
    </div>
    <script>
        function updateMeasureTotal() {
            var salePrice = parseFloat(document.getElementById('sale_price').value) || 0;
            var measure = parseFloat(document.getElementById('measure').value) || 0;
            var totalAmount = salePrice * measure;
            document.getElementById('total_amount_measure').value = totalAmount.toFixed(2);
        }

        function updateTotNoOfItemsTotal() {
            var salePrice = parseFloat(document.getElementById('sale_price').value) || 0;
            var totNoOfItems = parseFloat(document.getElementById('tot_no_of_items').value) || 0;
            var totalAmount = salePrice * totNoOfItems;
            document.getElementById('total_amount_tot_no_of_items').value = totalAmount.toFixed(2);
        }
    </script>
@endsection

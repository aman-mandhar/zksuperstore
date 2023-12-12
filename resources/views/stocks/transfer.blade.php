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
                <input type="number" name="unit_price" id="unit_price" class="form-control" placeholder="Weight" value="{{ $stock->sale_price }}" readonly>    
         </div>
                  
            <!-- Add other fields as needed -->
            @php
                $type = $stock->item->type; // Assuming there is a relationship between Stock and Item
            @endphp
            @if ($type === "Loose")                        
                <div class="form-group">
                    <label for="measure">Weight:</label>
                    <input type="number" name="measure" id="measure" class="form-control" placeholder="Weight">
                </div>
            @else
                <div class="form-group">
                    <label for="tot_no_of_items">Number of Items:</label>
                    <input type="number" name="tot_no_of_items" id="tot_no_of_items" class="form-control" placeholder="Number of Items">
                </div>
            @endif
        
            
        
            <div class="form-group">
                <label for="sale_price">ZK Price per item:</label>
                <input type="number" name="sale_price" id="sale_price" class="form-control" required placeholder="ZK Price per item">
            </div>
        
            <div class="form-group">
                <label for="cost">Total Cost:</label>
                <input type="number" name="cost" id="cost" class="form-control" readonly placeholder="0">
            </div>
        
            <div class="form-group">
                <label for="gross_profit">Gross Profit:</label>
                <input type="number" name="gross_profit" id="gross_profit" class="form-control" readonly placeholder="0">
            </div>
        
            <div class="form-group">
                <label for="tot_points">Total Points:</label>
                <input type="number" name="tot_points" id="tot_points" class="form-control" readonly placeholder="0">
            </div>
        
            <div class="form-group">
                <label for="cash_discount">Cash Discount:</label>
                <input type="number" name="cash_discount" id="cash_discount" class="form-control" readonly placeholder="0">
            </div>
        
            <div class="form-group">
                <label for="pur_bill_no">Bill No.:</label>
                <input type="text" name="pur_bill_no" id="pur_bill_no" class="form-control">
                <input type="hidden" name="stock_id" id="stock_id" class="form-control" value="{{ $stock->id }}">
            </div>
        
            <!-- Add more fields based on your requirements -->
        
            <button type="submit" class="btn btn-primary">Add Stock</button>
        </form>
        
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select relevant input fields
            var purValueInput = document.getElementById('pur_value');
            var gstInput = document.getElementById('gst');
            var mrpInput = document.getElementById('mrp');
            var salePriceInput = document.getElementById('sale_price');
            var costInput = document.getElementById('cost');
            var grossProfitInput = document.getElementById('gross_profit');
            var totPointsInput = document.getElementById('tot_points');
            var cashDiscountInput = document.getElementById('cash_discount');
    
            // Add event listeners to the input fields
            purValueInput.addEventListener('input', updateCalculations);
            gstInput.addEventListener('input', updateCalculations);
            mrpInput.addEventListener('input', updateCalculations);
            salePriceInput.addEventListener('input', updateCalculations);
    
            // Function to update calculated fields
            function updateCalculations() {
                // Get values from input fields
                var purValue = parseFloat(purValueInput.value) || 0;
                var gst = parseFloat(gstInput.value) || 0;
                var mrp = parseFloat(mrpInput.value) || 0;
                var salePrice = parseFloat(salePriceInput.value) || 0;
    
                // Calculate cost
                var cost = purValue + gst;
    
                // Calculate gross profit
                var grossProfit = salePrice - cost;
    
                // Calculate tot points (80% of gross profit)
                var totPoints = 0.8 * grossProfit;
    
                // Calculate cash discount
                var cashDiscount = mrp - salePrice;
    
                // Update values in the readonly fields
                costInput.value = cost.toFixed(2);
                grossProfitInput.value = grossProfit.toFixed(2);
                totPointsInput.value = totPoints.toFixed(2);
                cashDiscountInput.value = cashDiscount.toFixed(2);
            }
        });
    </script>
    
    
@endsection
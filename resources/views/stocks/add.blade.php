@extends('layouts.app')

@section('content')

    <div class="container col-md-6">
        <h2>Add Stock</h2>
        <span>for</span>
       
        <table class="table col-md-6">
            <tbody>
                <tr>
                    <td>
                        <img src="{{ asset($item->prod_pic) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;"><br>
                        <strong>{{ $item->type }}</strong>
                    </td>
                    <td><strong>{{ $item->name }}</strong><br>{{ $item->description }}<br><span><i>{{ $item->prod_cat }}</i></span></strong></td>
                 </tr>
            </tbody>
        </table>
        <form action="{{ route('stocks.store') }}" method="POST" class="col-md-6">
            @csrf
        
            <select name="merchant" id="merchant" class="form-control" required>
                <option value="Open Market" selected>Open Market</option>
                @foreach($merchants as $merchant)
                    <option value="{{ old($merchant->name) }}">{{ $merchant->name }}</option>
                @endforeach
            </select>
        
            <!-- Add other fields as needed -->
            @if ($item->type === "Loose")                        
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
                <label for="pur_value">Purchase Amount per item:</label>
                <input type="number" name="pur_value" id="pur_value" class="form-control" required placeholder="Purchase Amount per item">
            </div>
        
            <div class="form-group">
                <label for="gst">Total GST Paid:</label>
                <input type="number" name="gst" id="gst" class="form-control" required placeholder="Total GST Paid">
            </div>
        
            <div class="form-group">
                <label for="mrp">Market Price:</label>
                <input type="number" name="mrp" id="mrp" class="form-control" required placeholder="Market Price">
            </div>
        
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
                <input type="hidden" name="item_id" id="item_id" class="form-control" value="{{ $item->id }}">
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
@extends('layouts.admin')

@section('content')

    <div class="container col-md-6">
        <span><h5> Stock Request for</h5></span>
        <table class="table col-md-9">
                <tr>
                    <td>
                        @php
                        $name = $stock->item->name; // Assuming there is a relationship between Stock and Item
                        $description = $stock->item->description; // Assuming there is a relationship between Stock and Item
                        $prod_cat = $stock->item->prod_cat; // Assuming there is a relationship between Stock and Item
                    @endphp
                    <b>{{ $name }}</b>
                    <br>
                    <small>{{ $description }}</small>
                        
                    </td>
                    <td>
                        @php
                            $img = $stock->item->prod_pic; // Assuming there is a relationship between Stock and Item
                        @endphp
                        <img src="{{ asset($img) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">
                        <br>
                        <small>{{ $prod_cat }}</small>
                    </td>
                </tr>
        </table>
        <form action="{{ route('transfers.store') }}" method="POST" class="col-md-6">
            @csrf
            <table class="table col-md-9">
                    <tr>
                        <td class="col-md-3">
                            <label for="sale_price">Sale Price:</label>
                        </td>
                        <td class="col-md-3">
                            <input type="number" name="sale_price" id="sale_price" class="form-control" placeholder="Sale Price" value="{{ $stock->sale_price }}" readonly> 
                        </td>                        
                    </tr>
                    <tr>
                        <td class="col-md-3">
                            <label for="points">Reward Points on sale <i>per unit</i> :</label>
                        </td>
                        <td class="col-md-3">
                            <input type="number" name="points" id="points" class="form-control" readonly
                                @if ($user->user_role == 2)
                                value="{{ 0.50 * $stock->tot_points }}"
                                @elseif ($user->user_role == 4)
                                value="{{ 0.25 * $stock->tot_points }}"
                                @endif
                            >   
                        </td>
                    </tr>
                    <tr>
                        <th class="table col-md-3">Requirement</th>
                        <th class="table col-md-3">
                            @php
                                $type = $stock->item->type; // Assuming there is a relationship between Stock and Item
                            @endphp
                            @if ($type === "Loose")                        
                                <div class=" form-group">
                                    <input type="number" name="measure" id="measure" class="form-control" placeholder="Weight in kg only" oninput="updateMeasureTotal()">
                                </div>
                                <div class="form-group">
                                    Total Amount
                                    <input type="number" name="total_amount_measure" id="total_amount_measure" placeholder="0" readonly>
                                </div>
                            @else
                                <div class="form-group">
                                    <input type="number" name="tot_no_of_items" id="tot_no_of_items" class="form-control" placeholder="Quantity required" oninput="updateTotNoOfItemsTotal()">
                                </div>
                                <div class="form-group">
                                    Total Amount
                                    <input type="number" name="total_amount_tot_no_of_items" id="total_amount_tot_no_of_items" placeholder="0" readonly>
                                </div>
                            @endif
                        </th>
                    </tr>
                </table>
            <!-- Add more fields based on your requirements -->
            <input type="hidden" name="stock_id" value="{{ $stock->id }}">
            <input type="hidden" name="item_id" value="{{ $stock->item->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="status" value="pending">        
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

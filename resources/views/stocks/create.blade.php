@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Stock') }}</div>

                <div class="card-body">
                    <form class="col-md-12" method="post" action="{{ route('stocks.store') }}">
                        @csrf {{-- CSRF protection --}}

                        <div class="form-group">
                            <label for="search">Search:</label>
                            <input type="text" id="search" class="form-control" placeholder="Search items">
                        </div>

                        <table class="table col-md-12" id="itemsTable">
                            <tbody class="col-md-12">
                                @foreach($items as $item)
                                <tr class="item-row col-md-12" data-type="{{ $item->type }}">
                                    <td>
                                        <input type="checkbox" name="selected_items[]" value="{{ $item->id }}">
                                    </td>
                                    <td><img src="{{ asset($item->prod_pic) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;"></td>
                                    <td class="item-details">
                                        <span>{{ $item->name }}<br>{{ $item->description }}</span>
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->prod_cat }}</td>
                                    <td>{{ $item->gst }}</td>
                                    <td>
                                        <div class="form-group pur_value-field">
                                            <input type="number" name="pur_value" step="0.01" class="form-control pur_value" value="{{ old('pur_value') }}" placeholder="Amount" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group cgst-field">
                                            <input type="number" name="cgst" class="form-control" value="{{ old('cgst') }}" placeholder="CGST">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group sgst-field">
                                            <input type="number" name="sgst" class="form-control" value="{{ old('sgst') }}" placeholder="SGST">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mrp-field">
                                            <input type="number" name="mrp" class="form-control" value="{{ old('mrp') }}" placeholder="MRP">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group sale_price-field">
                                            <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}" placeholder="Sale Price">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group tot_points-field">
                                            <input type="number" name="tot_points" step="0.01" class="form-control" value="{{ old('tot_points') }}" placeholder="Points" required>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group measure-field" style="display: none;">
                                            <input type="text" name="measure" class="form-control" value="{{ old('measure') }}" placeholder="in weight">
                                        </div>
                                        <div class="form-group tot-no-of-items-field" style="display: none;">
                                            <input type="number" name="tot-no-of-items" class="form-control" value="{{ old('tot_no_of_items') }}" placeholder="No. of Items">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group pur_bill_no-field">
                                             <input type="text" name="pur_bill_no" class="form-control" id="pur_bill_no" value="{{ old('pur_bill_no') }}" placeholder="Bill No">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group merchant-field">
                                        <select name="merchant" id="merchant" class="form-control" required>
                                            <option value="Open Market" selected>Open Market</option>
                                            @foreach($merchants as $merchant)
                                                <option value="{{ old($merchant->id) }}">{{ $merchant->name }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </td>
                                    <input type="hidden" name="item_id[{{ $item->id }}]" value="{{ old($item->id) }}">
                                    <input type="hidden" name="prod_pic[{{ $item->prod_pic }}]" value="{{ old($item->prod_pic) }}">
                                    <input type="hidden" name="name[{{ $item->name }}]" value="{{ old($item->name) }}">
                                    <input type="hidden" name="description[{{ $item->description }}]" value="{{ old($item->description) }}">
                                    <input type="hidden" name="type[{{ $item->type }}]" value="{{ old($item->type) }}">
                                    <input type="hidden" name="prod_cat[{{ $item->prod_cat }}]" value="{{ old($item->prod_cat) }}">
                                    <input type="hidden" name="gst[{{ $item->gst }}]" value="{{ old($item->gst) }}">
                                    <input type="hidden" name="qrcode" value="{{ old('qrcode') }}">
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary">Add Stock</button>
                    </form>

                    <script>
                        // JavaScript for table filtering and dynamic field display
                        document.getElementById('search').addEventListener('input', function () {
                            let filter = this.value.toLowerCase();
                            let rows = document.querySelectorAll('.item-row');

                            for (let row of rows) {
                                let shouldDisplay = Array.from(row.getElementsByClassName('item-details')[0].getElementsByTagName('span')).some(span => {
                                    let text = span.textContent.toLowerCase();
                                    return text.includes(filter);
                                });

                                row.style.display = shouldDisplay ? '' : 'none';
                            }
                        });

                        // JavaScript for fetching the 'type' when checkbox is clicked
                        document.addEventListener('change', function (event) {
                            // Check if the change event occurred on a checkbox with the name 'selected_items[]'
                            if (event.target.type === 'checkbox' && event.target.name === 'selected_items[]') {
                                var selectedItem = event.target;
                                var itemRow = selectedItem.closest('.item-row');
                                var measureField = itemRow.querySelector('.measure-field');
                                var totNoOfItemsField = itemRow.querySelector('.tot-no-of-items-field');

                                // Hide both fields initially
                                measureField.style.display = 'none';
                                totNoOfItemsField.style.display = 'none';

                                // Fetch the 'type' attribute from the selected item
                                var itemTypeName = itemRow.getAttribute('data-type');

                                // Show the relevant field based on the item type
                                if (itemTypeName === 'Loose') {
                                    measureField.style.display = 'block';
                                } else {
                                    totNoOfItemsField.style.display = 'block';
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

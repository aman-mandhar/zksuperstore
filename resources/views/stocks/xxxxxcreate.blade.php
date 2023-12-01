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
                                        <div class="form-group">
                                            <input type="number" step="0.01" class="form-control pur-value" name="pur_value[{{ $item->id }}]" id="pur_value_{{ $item->id }}" value="{{ old('pur_value.' . $item->id) }}" placeholder="Amount" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group cgst-field">
                                            <input type="number" step="0.01" class="form-control cgst" name="cgst[{{ $item->id }}]" id="cgst_{{ $item->id }}" value="{{ old('cgst.' . $item->id) }}" placeholder="CGST">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group sgst-field">
                                            <input type="number" step="0.01" class="form-control sgst" name="sgst[{{ $item->id }}]" id="sgst_{{ $item->id }}" value="{{ old('sgst.' . $item->id) }}" placeholder="SGST">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mrp-field">
                                            <input type="number" step="0.01" class="form-control mrp" name="mrp[{{ $item->id }}]" id="mrp_{{ $item->id }}" value="{{ old('mrp.' . $item->id) }}" placeholder="MRP">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group sale_price-field">
                                            <input type="number" step="0.01" class="form-control sale_price" name="sale_price[{{ $item->id }}]" id="sale_price_{{ $item->id }}" value="{{ old('sale_price.' . $item->id) }}" placeholder="Sale price">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group tot_points">
                                            <input type="number" step="0.01" class="form-control tot_points" name="tot_points[{{ $item->id }}]" id="tot_points_{{ $item->id }}" value="{{ old('tot_points.' . $item->id) }}" placeholder="Points">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-group measure-field" style="display: none;">
                                            <input type="number" step="0.01" class="form-control measure" name="measure[{{ $item->id }}]" id="measure_{{ $item->id }}" value="{{ old('measure.' . $item->id) }}" placeholder="Weight">
                                        </div>
                                        <div class="form-group tot-no-of-items-field" style="display: none;">
                                            <input type="number" step="0.01" class="form-control tot-no-of-items" name="tot-no-of-items[{{ $item->id }}]" id="tot-no-of-items_{{ $item->id }}" value="{{ old('tot-no-of-items.' . $item->id) }}" placeholder="Items">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group pur_bill_no-field">
                                            <input type="number" step="0.01" class="form-control pur_bill_no" name="pur_bill_no[{{ $item->id }}]" id="pur_bill_no_{{ $item->id }}" value="{{ old('pur_bill_no.' . $item->id) }}" placeholder="Bill No.">
                                        </div>
                                    </td>
                                    <td>
                                        <select name="merchant[{{ $item->id }}]" id="merchant_{{ $item->id }}" class="form-control" required>
                                            <option value="Open Market" selected>Open Market</option>
                                            @foreach($merchants as $merchant)
                                                <option value="{{ old($merchant->id) }}">{{ $merchant->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <input type="hidden" name="item_id[{{ $item->id }}]" value="{{ old($item->id) }}">
                                    <input type="hidden" name="prod_pic[{{ $item->id }}]" value="{{ old($item->prod_pic) }}">
                                    <input type="hidden" name="name[{{ $item->id }}]" value="{{ old($item->name) }}">
                                    <input type="hidden" name="description[{{ $item->id }}]" value="{{ old($item->description) }}">
                                    <input type="hidden" name="type[{{ $item->id }}]" value="{{ old($item->type) }}">
                                    <input type="hidden" name="prod_cat[{{ $item->id }}]" value="{{ old($item->prod_cat) }}">
                                    <input type="hidden" name="gst[{{ $item->id }}]" value="{{ old($item->gst) }}">
                                    <input type="hidden" name="qrcode[{{ $item->id }}]" value="{{ old('qrcode.' . $item->id) }}">
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Add Stock') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('stocks.store') }}">
                        @csrf {{-- CSRF protection --}}

                        <div class="form-group">
                            <label for="search">Search:</label>
                            <input type="text" id="search" class="form-control" placeholder="Search items">
                        </div>

                        <table class="table" id="itemsTable">

                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" data-type="{{ $item->type }}">
                                    
                                    <img src="{{ asset($item->prod_pic) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">
                                    <span>{{ $item->name }}<br>{{ $item->description }}</span>
                                    
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input id="pur_value_{{ $item->id }}" type="number" step="0.01" class="form-control @error('pur_value') is-invalid @enderror" name="pur_value" value="{{ old('pur_value') }}" placeholder="Purchase Amount" required>
                                                @error('pur_value')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        {{-- Measure field --}}
                                        <div class="form-group" id="measureField_{{ $item->id }}" style="display: none;">
                                            <input type="text" name="measure" class="form-control" placeholder="in weight">
                                        </div>
                                    
                                    {{-- Total Number of Items field --}}
                                    
                                        <div class="form-group" id="totNoOfItemsField_{{ $item->id }}" style="display: none;">
                                            <input type="number" name="tot_no_of_items" class="form-control" placeholder="No. of Items">
                                        </div>
                                    
                                        
                                    </td>
                                    <input type="hidden" name="prod_pics[{{ $item->id }}]" value="{{ $item->prod_pic }}">
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
                            let rows = document.getElementById('itemsTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                            for (let row of rows) {
                                let shouldDisplay = Array.from(row.children).some(cell => {
                                    let text = cell.textContent.toLowerCase();
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
                                var itemType = selectedItem.getAttribute('data-type');
                                var itemId = selectedItem.value;
                                var measureField = document.getElementById('measureField_' + itemId);
                                var totNoOfItemsField = document.getElementById('totNoOfItemsField_' + itemId);

                                // Hide both fields initially
                                measureField.style.display = 'none';
                                totNoOfItemsField.style.display = 'none';

                                // Fetch the 'type' attribute from the selected item
                                var itemTypeName = selectedItem.getAttribute('data-type');

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

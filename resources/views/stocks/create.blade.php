@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                    <td><input type="checkbox" name="selected_items[]" value="{{ $item->id }}"></td>
                    <td>
                        <img src="{{ asset($item->prod_pic) }}" alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">
                    <td><input type="text" name="{{ $item->name }}]" value="{{ $item->name }}"></td>
                    <td>
                        {{-- Measure field --}}
                        <div class="form-group" id="measureField" style="display: none;">
                            <label for="measure">Measure (in kilograms and grams)</label>
                            <input type="text" name="measure" id="measure" class="form-control">
                        </div>
                    </td>
                    <td>
                        {{-- Total Number of Items field --}}
                        <div class="form-group" id="totNoOfItemsField" style="display: none;">
                            <label for="tot_no_of_items">Total Number of Items</label>
                            <input type="number" name="tot_no_of_items" id="tot_no_of_items" class="form-control">
                        </div>
                    </td>
                    <td>

                    </td>
                    <td>
                        <div class="form-group row">
                            <label for="pur_value" class="col-md-4 col-form-label text-md-right">{{ __('Purchase Value of Item') }}</label>
                            <div class="col-md-6">
                                <input id="pur_value" type="number" step="0.01" class="form-control @error('pur_value') is-invalid @enderror" name="pur_value" value="{{ old('pur_value') }}" required>
                                @error('pur_value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->type }}</td>
                    <td><input type="number" 
                               name="items_required[{{ $item->id }}]" 
                               class="form-control" 
                               placeholder="3Kg -> 3 or 5 Items ->5">
                    </td>
                    
                        <input type="hidden" name="prod_pics[{{ $item->id }}]" value="{{ $item->prod_pic }}">
                    </td>
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


// JavaScript for fetching the 'type'
document.getElementById('search').addEventListener('change', function () {
    var selectedItem = this.options[this.selectedIndex];
    var itemType = selectedItem.getAttribute('data-type');
    var measureField = document.getElementById('measureField');
    var totNoOfItemsField = document.getElementById('totNoOfItemsField');

    // Hide both fields initially
    measureField.style.display = 'none';
    totNoOfItemsField.style.display = 'none';

    // Fetch the 'type' attribute from the selected item
    var itemTypeName = selectedItem.getAttribute('data-type');

    // Show the relevant field based on the item type
    if (itemTypeName === 'Loose') {
        measureField.style.display = 'block';
        // Reset the tot_no_of_items field
        document.getElementById('tot_no_of_items').value = '';
    } else {
        totNoOfItemsField.style.display = 'block';
        // Reset the measure field
        document.getElementById('measure').value = '';
    }
});

</script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

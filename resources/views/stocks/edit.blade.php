<!-- resources/views/stocks/create.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Stock') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('stocks.store') }}">
                        @csrf {{-- CSRF protection --}}
            
                        {{-- Input fields for the stock --}}
                        <div class="form-group">
                            <label for="name">Item Name</label>
                            <select name="name" id="name" class="form-control" required>
                                <option value="" disabled selected>Select an item</option>
                                @foreach($items as $item)
                                <option value="{{ $item->name }}" data-type="{{ $item->type }}">{{ $item->name }}</option>

                                @endforeach
                            </select>
                        </div>
                                   
                        {{-- Measure field --}}
                        <div class="form-group" id="measureField" style="display: none;">
                            <label for="measure">Measure (in kilograms and grams)</label>
                            <input type="text" name="measure" id="measure" class="form-control">
                        </div>
            
                        {{-- Total Number of Items field --}}
                        <div class="form-group" id="totNoOfItemsField" style="display: none;">
                            <label for="tot_no_of_items">Total Number of Items</label>
                            <input type="number" name="tot_no_of_items" id="tot_no_of_items" class="form-control">
                        </div>
            
                        
                    
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
                    <div class="form-group row">
                      <label for="mrp" class="col-md-4 col-form-label text-md-right">{{ __('Maximum Retail Price') }}</label>
                      <div class="col-md-6">
                          <input id="mrp" type="number" step="0.01" class="form-control @error('mrp') is-invalid @enderror" name="mrp" value="{{ old('mrp') }}" required>
                          @error('mrp')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  
            
            <div class="form-group row">
                <label for="pur_bill_no" class="col-md-4 col-form-label text-md-right">{{ __('Purchase Bill Number') }}</label>
                <div class="col-md-6">
                    <input id="pur_bill_no" type="text" class="form-control @error('pur_bill_no') is-invalid @enderror" name="pur_bill_no" value="{{ old('pur_bill_no') }}" required>
                    @error('pur_bill_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="merchant" class="col-md-4 col-form-label text-md-right">{{ __('Merchant') }}</label>
                <div class="col-md-6">
                    <input id="merchant" type="text" class="form-control @error('merchant') is-invalid @enderror" name="merchant" value="{{ old('merchant', 'Open Market') }}" nullable>
                    @error('merchant')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="sale_price" class="col-md-4 col-form-label text-md-right">{{ __('Sale Price of Item') }}</label>
                <div class="col-md-6">
                    <input id="sale_price" type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" name="sale_price" value="{{ old('sale_price') }}" required>
                    @error('sale_price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="tot_points" class="col-md-4 col-form-label text-md-right">{{ __('Total Points') }}</label>
                <div class="col-md-6">
                    <input id="tot_points" type="number" step="0.01" class="form-control @error('tot_points') is-invalid @enderror" name="tot_points" value="{{ old('tot_points', '0.00') }}" required>
                    @error('tot_points')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                           {{-- Hidden user_id field --}}
                           <div class="form-group">
                           <input type="text" name="user_id" value="{{ auth()->id() }}" readonly>
            </div>
        </div>
           

            
            <!-- Add other form fields as per your schema -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Stock') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('name').addEventListener('change', function () {
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

   
@endsection





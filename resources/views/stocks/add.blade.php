<!-- resources/views/stocks/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Stock') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('stocks.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Item Name') }}</label>
                            <div class="col-md-6">
                                <select id="name" class="form-control @error('name') is-invalid @enderror" name="name" required>
                                    <option value="" selected disabled>Select an item</option>
                                    @foreach ($items as $itemId => $itemName)
                                        <option value="{{ $itemId }}" data-type="{{ $itemTypes[$itemId] }}">{{ $itemName }} (ID: {{ $itemId }})</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="item_id" class="col-md-4 col-form-label text-md-right">{{ __('Item ID') }}</label>
                            <div class="col-md-6">
                                <input id="item_id" type="text" class="form-control" name="item_id" readonly>
                                <!-- You can make it read-only or hidden, depending on your preference -->
                            </div>
                        </div>

                        <div class="form-group row" id="measure-container">
                            <label for="measure" class="col-md-4 col-form-label text-md-right">{{ __('Measurement') }} <br>e.g. 3kg 500grm = 3.500</label>
                            <div class="col-md-6">
                                <input id="measure" type="number" step="0.001" class="form-control @error('measure') is-invalid @enderror" name="measure" placeholder="Enter measurement" value="{{ old('measure') }}">
                                @error('measure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row" id="tot_no_of_items-container">
                            <label for="tot_no_of_items" class="col-md-4 col-form-label text-md-right">{{ __('Total Number of Items') }}</label>
                            <div class="col-md-6">
                                <input id="tot_no_of_items" type="number" class="form-control @error('tot_no_of_items') is-invalid @enderror" name="tot_no_of_items" value="{{ old('tot_no_of_items') }}">
                                @error('tot_no_of_items')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                    <div class="form-group row">
                        <label for="pur_value" class="col-md-4 col-form-label text-md-right">{{ __('Purchase Value') }}</label>
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
                <label for="sale_price" class="col-md-4 col-form-label text-md-right">{{ __('Sale Price') }}</label>
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
    document.addEventListener('DOMContentLoaded', function () {
        var nameSelect = document.getElementById('name');
        var measureFieldContainer = document.getElementById('measure-container');
        var totNoOfItemsContainer = document.getElementById('tot_no_of_items-container');

        nameSelect.addEventListener('change', function () {
            var selectedOption = nameSelect.options[nameSelect.selectedIndex];
            var itemType = selectedOption.getAttribute('data-type');

            // Show/hide fields and labels based on item type
            if (itemType === 'Loose') {
                measureFieldContainer.style.display = 'block';
                totNoOfItemsContainer.style.display = 'none';
            } else {
                measureFieldContainer.style.display = 'none';
                totNoOfItemsContainer.style.display = 'block';
            }
        });
    });
    
    document.addEventListener('DOMContentLoaded', function () {
        var nameSelect = document.getElementById('name');
        var itemIDField = document.getElementById('item_id');

        nameSelect.addEventListener('change', function () {
            var selectedOption = nameSelect.options[nameSelect.selectedIndex];
            var itemID = selectedOption.value;

            // Set the value of the item_id field
            itemIDField.value = itemID;
        });

        // Trigger the change event on page load to initialize the item_id field
        var event = new Event('change');
        nameSelect.dispatchEvent(event);
    });


</script>
   
@endsection





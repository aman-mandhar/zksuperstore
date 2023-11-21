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
                                      <option value="{{ $itemId }}">{{ $itemName }}</option>
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
                      </div>
                      <div class="form-group row">
                        <label for="tot_no_of_items" class="col-md-4 col-form-label text-md-right">{{ __('Total Number of Items') }}</label>
                        <div class="col-md-6">
                            <input id="tot_no_of_items" type="number" class="form-control @error('tot_no_of_items') is-invalid @enderror" name="tot_no_of_items" value="{{ old('tot_no_of_items') }}" required>
                            @error('tot_no_of_items')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
                    <label for="gst" class="col-md-4 col-form-label text-md-right">{{ __('GST Paid') }}</label>
                    <div class="col-md-6">
                        <input id="gst" type="number" step="0.01" class="form-control @error('gst') is-invalid @enderror" name="gst" value="{{ old('gst') }}" nullable>
                        @error('gst')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                  <label for="cgst" class="col-md-4 col-form-label text-md-right">{{ __('CGST Paid') }}</label>
                  <div class="col-md-6">
                      <input id="cgst" type="number" step="0.01" class="form-control @error('cgst') is-invalid @enderror" name="cgst" value="{{ old('cgst') }}" nullable>
                      @error('cgst')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group row">
                <label for="transit_charges" class="col-md-4 col-form-label text-md-right">{{ __('Transit Charges') }}</label>
                <div class="col-md-6">
                    <input id="transit_charges" type="number" step="0.01" class="form-control @error('transit_charges') is-invalid @enderror" name="transit_charges" value="{{ old('transit_charges') }}" nullable>
                    @error('transit_charges')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row">
                <label for="tot_pur_value" class="col-md-4 col-form-label text-md-right">{{ __('Total Purchase Value') }}</label>
                <div class="col-md-6">
                    <input id="tot_pur_value" type="number" step="0.01" class="form-control @error('tot_pur_value') is-invalid @enderror" name="tot_pur_value" value="{{ old('tot_pur_value') }}" required>
                    @error('tot_pur_value')
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
                <label for="tot_issued_points" class="col-md-4 col-form-label text-md-right">{{ __('Total Issued Points') }}</label>
                <div class="col-md-6">
                    <input id="tot_issued_points" type="number" step="0.01" class="form-control @error('tot_issued_points') is-invalid @enderror" name="tot_issued_points" value="{{ old('tot_issued_points', '0.00') }}" required>
                    @error('tot_issued_points')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- Add the read-only 'wh_id' field -->
<!-- Display the mobile_number field of the current logged-in user -->
<div class="form-group row">
  <label for="mobile_number" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
  <div class="col-md-6">
      <input id="mobile_number" type="text" class="form-control" name="mobile_number" value="{{ Auth::user()->mobile_number }}" readonly>
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
   
@endsection





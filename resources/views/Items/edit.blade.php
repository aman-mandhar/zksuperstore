@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Item</h2>
        <form action="{{ route('items.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $item->description }}</textarea>
            </div>

            <div class="form-group row">
                <label for="prod_cat" class="col-md-4 col-form-label text-md-right">{{ __('Product Category') }}</label>
                <div class="col-md-6">
                    <select id="prod_cat" class="form-control @error('prod_cat') is-invalid @enderror" name="prod_cat" required>
                        <option value="" selected disabled>Select a category</option>
                        <option value="Health Products">Health Products</option>
                        <option value="Crockery">Crockery</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Grocery">Grocery</option>
                        <option value="Garments">Garments</option>
                        <option value="Service">Services</option>
                    </select>
                    @error('prod_cat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Product Type') }}</label>
                <div class="col-md-6">
                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                        <option value="Packet">Packet</option>
                        <option value="Loose">Loose</option>
                        
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="prod_pic">Product Picture:</label>
                <input type="file" class="form-control-file" id="prod_pic" name="prod_pic">
                @if($item->prod_pic)
                    <img src="{{ asset($item->prod_pic) }}" alt="Product Image" style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </div>
@endsection
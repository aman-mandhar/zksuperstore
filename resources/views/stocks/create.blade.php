@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit Item</h2>
        <form action="{{ route('stocks.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" readonly>{{ $item->description }}</textarea>
            </div>

            <div class="form-group row">
                <label for="prod_cat" class="col-md-4 col-form-label text-md-right">{{ __('Product Category') }}</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="prod_cat" name="prod_cat" value="{{ $item->prod_cat }}" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Product Type') }}</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="type" name="type" value="{{ $item->type }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="prod_pic">Product Picture:</label>
                @if($item->prod_pic)
                    <img src="{{ asset($item->prod_pic) }}" alt="Product Image" style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </div>
@endsection
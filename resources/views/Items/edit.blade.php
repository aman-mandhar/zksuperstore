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

            <div class="form-group">
                <label for="prod_cat">Category:</label>
                <input type="text" class="form-control" id="prod_cat" name="prod_cat" value="{{ $item->prod_cat }}" required>
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
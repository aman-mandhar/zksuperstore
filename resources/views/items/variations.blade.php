@extends('layouts.admin')
@section('content')
    <h5>Add New Variation</h5>
    <form action="{{ route('variations.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="item_id">Item</label>
            <select name="item_id" id="item_id" class="form-control">
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subcategory_id">Sub Category</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control">
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" id="color" class="form-control">
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" id="size" class="form-control">
        </div>
        <button type="submit">Add Variation</button>
    </form>
    <h5>All Variations</h5>
    <table class="table col-md-6">
        <thead class="col-md-6">
            <tr class="row-md-6">
                <th class="col-md-3">Item Name</th>
                <th class="col-md-3">Variation Name</th>
                <th class="col-md-3">Sub Category</th>
                <th class="col-md-3">Category</th>
                <th class="col-md-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($variations as $variation)
                <tr>
                    <td class="col-md-3">{{ $variation->item->name }}</td>
                    <td class="col-md-3">{{ $variation->name }}</td>
                    <td class="col-md-3">{{ $variation->item->sub_category->name }}</td>
                    <td class="col-md-3">{{ $variation->item->sub_category->category->name }}</td>
                    <td class="col-md-3">
                        <form action="{{ route('variations.destroy', $variation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
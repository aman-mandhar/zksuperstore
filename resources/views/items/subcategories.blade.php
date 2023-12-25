@extends('layouts.admin')
@section('content')
    <h5>Add New Subcategory</h5>
    <form action="{{ route('subcategories.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <input type="text" name="name" id="name" placeholder="Subcategory Name">
        <button type="submit">Add Subcategory</button>
    </form>
    <h5>All Subcategories</h5>
    <table class="table col-md-6">
        <thead class="col-md-6">
            <tr class="row-md-6">
                <th class="col-md-3">Subcategory Name</th>
                <th class="col-md-3">Category Name</th>
                <th class="col-md-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $subcategory)
                <tr>
                    <td class="col-md-3">{{ $subcategory->name }}</td>
                    <td class="col-md-3">{{ $subcategory->category->name }}</td>
                    <td class="col-md-3">
                        <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST">
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
@extends('layouts.admin') {{-- Assuming you have a layout file --}}

@section('content')
    <h5>Add New Category</h5>
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <input type="text" name="name" id="name" placeholder="Category Name">
        <button type="submit">Add Category</button>
    </form>
        <h5>All Categories</h5>
        <table class="table col-md-6">
            <thead class="col-md-6">
                <tr class="row-md-6">
                    <th class="col-md-3">Category Name</th>
                    <th class="col-md-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="col-md-3">{{ $category->name }}</td>
                        <td class="col-md-3">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
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
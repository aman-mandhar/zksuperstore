<!-- resources/views/items/create.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file, modify as needed -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Item</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('items.store') }}">
                            @csrf

                            <!-- Add your form fields here -->
                            <div class="form-group">
                                <label for="name">Item Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <!-- Add more form fields as needed -->

                            <button type="submit" class="btn btn-primary">Create Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

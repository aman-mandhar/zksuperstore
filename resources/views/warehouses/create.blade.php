@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Retail Store</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('warehouses.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="user_id">User:</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    @foreach($users as $user)
                                        @if($user->user_role == 3)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="store_add">Warehouse Address:</label>
                                <input type="text" name="store_add" id="store_add" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" name="city" id="city" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="manager">Manager:</label>
                                <input type="text" name="manager" id="manager" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="mobile_no">Mobile Number:</label>
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Retail Store</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

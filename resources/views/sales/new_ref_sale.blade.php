@extends('layouts.app')
@section('content')
    <form action="{{ route('sales.new_ref_sale') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Customer mobile number" name="search" id="search" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>
@endsection
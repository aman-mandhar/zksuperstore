<!-- resources/views/stocks/create.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>Stock Requirement</h2><br>
        <p><i>Per Item List</i></p>
        {{-- Search Form --}}
        <form action="" method="GET" class="col-3">
            <div class="input-group">
                <input type="search" class="form-control" placeholder="Search by name or category" name="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
                <a href="{{url('transfers/create')}}">
                <button type="button" class="btn btn-outline-secondary">Reset</button></a>
            </div>
        </form>       
        
        {{-- Display Items 
        <form action="{{ route('saveRequirements') }}" method="post">
            @csrf--}}
        <table class="table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Sale Peice<br><i>per item/kg</i></th>
                    <th>points on Sale</th>
                    <th>Requirement</th>
                    

                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
            <tr>
            <td>{{ $stock->name }}</td>
            <td>{{ $stock->sale_price }}</td>
            <td>{{ $stock->tot_points }}</td>
            <td><input type="number" name="items_required" id="items_required" class="form-control" placeholder="3Kg -> 3 or 5 Items ->5"></td>
        </tr>
  @endforeach
           </tbody>
        </table>
        <button type="submit" class="btn btn-success">Save Requirements</button>
    <!--</form>-->
    </div>
@endsection




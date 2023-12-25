<!-- resources/views/items/create.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Item') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gst" class="col-md-4 col-form-label text-md-right">{{ __('Applicable GST Rate in %') }} </label>
                            <div class="col-md-6">
                                <input id="gst" type="text" class="form-control @error('gst') is-invalid @enderror" name="gst" value="{{ old('gst') }}" required autofocus>
                                @error('gst')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Product Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>
                                @error('Description')
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
                        <div class="form-group row">
                            <label for="prod_cat" class="col-md-4 col-form-label text-md-right">{{ __('Product Category') }}</label>
                            <div class="col-md-6">
                                <select id="prod_cat" class="form-control @error('prod_cat') is-invalid @enderror" name="prod_cat" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('prod_cat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="subcategory_id" class="col-md-4 col-form-label text-md-right">{{ __('Product Subcategory') }}</label>
                            <div class="col-md-6">
                                <select id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id">
                                    <option value="" >Select a subcategory</option>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }} ({{ $subcategory->category->name }})</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="variation_id" class="col-md-4 col-form-label text-md-right">{{ __('Product Variation') }}</label>
                            <div class="col-md-6">
                                <select id="variation_id" class="form-control @error('variation_id') is-invalid @enderror" name="variation_id">
                                    <option value="" >Select a variation</option>
                                    @foreach($variations as $variation)
                                        <option value="{{ $variation->id }}">{{ $variation->color }} - {{ $variation->size }} ({{ $variation->subcategory->name }})</option>
                                    @endforeach
                                </select>
                                @error('variation_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prod_pic" class="col-md-4 col-form-label text-md-right">{{ __('Product Picture') }}</label>
                            <div class="col-md-6">
                                <input id="prod_pic" type="file" class="form-control @error('prod_pic') is-invalid @enderror" name="prod_pic">
                                @error('prod_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Item') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.app')
@section('title', 'View Product')
@section('content')
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @php
        $errorMessages = $errors->all();
        @endphp
        <li>{!! implode('</li>
        <li>', $errorMessages) !!}</li>
    </ul>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Product</div>

                <div class="card-body">
                    <!-- Form thêm sản phẩm -->
                    <form action="{{ route('product.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Product Price</label>
                            <input type="number" class="form-control" name="price" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Category</label>
                            <select class="form-control" name="category" required>
                                <option value="">Select Provider</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="provider_id">Provider</label>
                            <select class="form-control" name="provider_id" required>
                                <option value="">Select Provider</option>
                                @foreach($providers as $provider)
                                <option value="{{ $provider->provider_id }}">{{ $provider->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image_id">Quantity</label>
                            <input type="number" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="image_id">Image</label>
                            <input type="file" name="images[]" accept="image/*" multiple required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
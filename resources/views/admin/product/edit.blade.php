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


<form style="width: 100% ;min-height:100%" id='form__updatedish' class=" p-2 " enctype="multipart/form-data" action="{{url ('/admin/product/update/'. $product->product_id) }}" method="POST">
    @csrf
    <!-- Main content -->
    <section class="content card d-flex   p-2 align-items-center " style="height: 100%">
        <div class="col-sm-6 mb-2 mt-3 align-items-center">
            <h2>UPDATE DISH</h2>
        </div>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        {{session()->forget('success')}}
        @endif
        <div class="col-lg-9 " style="width:100%;">
            <div class="input-group mb-2" style="height: 40px;">
                <div class="input-group-prepend" style="height: 40px;">
                    <span class="input-group-text text-center" id="basic-addon1" style="min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">ID</span>
                </div>
                <input name="id" readonly style="height: 40px; background: white;" type="text" value="{{$product->product_id}}" class="form-control input-lg" id="inputlg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-2"  style="height: 40px;">
                <div class="input-group-prepend"  style="height: 40px;">
                    <span class="input-group-text" id="basic-addon1" style="min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">NAME</span>
                </div>
                <input name="name"  style="height: 40px;" type="text" value="{{$product->name}}" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-2"  style="height: 40px;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">DESCRIPTION</span>
                </div>
                <input name="description"  style="height: 40px;" type="text" value="{{$product->description}}" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-2"  style="height: 40px;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">PRICE</span>
                </div>
                <input name="price"  style="height: 40px;" type="text" value="{{$product->price}}" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-2"  style="height: 40px;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">CATEGORY</span>
                </div>
                <select  style="height: 40px;" class="form-control" name="category_id" required>
                    @foreach($categories as $c)
                    <option  name="category_id" value="{{ $c->category_id}}" @if($product->category_id == $c->category_id) selected @endif >{{ $c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-2"  style="height: 40px;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" style="min-width: 160px;font-weight:bold;font-size: 16px;text-align:center ">PROVIDER</span>
                </div>
                <select style="height: 40px;"    class="form-control" name="provider_id" required>
                    @foreach($provider as $pro)
                    <option name="provider_id" value="{{ $pro->provider_id}}" @if($product->provider_id == $pro->provider_id) selected @endif >{{ $pro->name}}</option>
                    @endforeach
                </select>
            </div>

        </div>



        <div class="row mt-2" style="width: 90%; margin: 0 auto;">
            <div class="col-4" style="width: 80%; height:160px">
                <input type="file" style="height: 160px;" name="images[]" accept="image/*" multiple class="border border-warning  position-relative image-update-dish">
            </div>

            <div class="col-8">
                <div style="width: 100%; height:160px; overflow-y:scroll" class="border border-warning d-flex  p-3" id="image-preview-container">
                    @foreach($product->images as $i)
                    <div style="height:90% ; aspect-ratio:1/1">
                        <img id="{{$i->image_id}}" accept="image/*" style="height:90% ; aspect-ratio:1/1" class="mr-2 image-dish-update" src="{{$i->url}}" alt="{{$i->id}}">
                        <button style="width:90%" class="btn btn-danger btn__delete--imagedish" data-id="{{$i->image_id}}">Delete</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div style="width: 100%" class="d-flex justify-content-end mt-2">
            <input style="height: 50px;" type="submit" class="btn btn-danger" value='Update this dish'>
        </div>

        </div>

        </div>


    </section>


</form>
{{-- <input type="file" name="images[]" accept="image/*" multiple> --}}
@endsection

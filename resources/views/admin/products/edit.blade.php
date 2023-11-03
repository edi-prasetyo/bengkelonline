@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    @if(session('message'))
    <div class="alert alert-danger">{{session('message')}}</div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Edit Product</h4>
            <a href="{{ url('admin/products') }}" class="btn btn-success text-white"><i
                    class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form action="{{ url('admin/products/' .$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Category</label>
                        <select name="category_id" id="country-dropdown"
                            class="form-select form-select mb-3 @error('category_id') is-invalid @enderror">
                            <option value="">--Select Category--</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>



                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{$product->name}}" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control">{{$product->description}}</textarea>
                    </div>
                    <h3 class="my-3 pt-3 border-top">Meta Tag Seo</h3>
                    <div class="col-md-6">
                        <label class="form-label">meta Title</label>
                        <textarea name="meta_title" class="form-control">{{$product->meta_title}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">meta description </label>
                        <textarea name="meta_description" class="form-control">{{$product->meta_description}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">meta keyword</label>
                        <textarea name="meta_keyword" class="form-control">{{$product->meta_keyword}}</textarea>
                    </div>
                    <h3 class="my-3 pt-3 border-top">Detail</h3>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Price Product</label>
                        <input type="text" name="price_product"
                            class="form-control @error('price_product') is-invalid @enderror"
                            value="{{$product->price_product}}">
                        @error('price_product')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Price Service</label>
                        <input type="text" name="price_service"
                            class="form-control @error('price_service') is-invalid @enderror"
                            value="{{$product->price_service}}">
                        @error('price_service')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Status</label>
                                <input class="form-check-input" type="checkbox" name="status" {{$product->status == '1'
                                ? 'checked':''}}>
                            </div>
                        </div>
                    </div>
                    <h3 class="my-3 pt-3 border-top">Images</h3>
                    <div class="col-md-4">
                        <label class="form-label">Image Cover</label>
                        <input type="file" name="image_cover" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <img src="{{asset($product->image_cover) }}" class="img-fluid">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Product Image</label>
                        <input type="file" multiple name="image[]" class="form-control">
                    </div>
                    <div class="row my-3">
                        @if($product->productImages)
                        @foreach($product->productImages as $image)
                        <div class="col-md-2">
                            <div class="card border p-2">
                                <img class="img-fluid" src="{{asset($image->image)}}">
                                <a href="{{url('admin/product-image/delete/' .$image->id)}}"
                                    class="btn btn-danger mt-2 text-white">Remove</a>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h3>No Images added </h3>
                        @endif
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')



@endsection
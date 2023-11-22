@extends('layouts.admin')

@section('content')
@if(session('message'))
<div class="alert alert-danger">
    {{session('message')}}
</div>
@endif
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white">
            <h4>Edit Service</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/services/update/' .$service->id)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Jasa</label>
                                <input type="text" name="name" class="form-control" value="{{$service->name}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harga Jasa</label>
                                <input type="text" name="service_price" class="form-control"
                                    value="{{$service->service_price}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="col-md-4 my-3">
                            <img src="{{asset($service->image)}}" class="img-fluid">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Status</label>
                                <input class="form-check-input" type="checkbox" name="status" {{$service->status == '1'
                                ? 'checked':''}}>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    @if(session('message'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Harga Jasa</h4>
            <a href="{{url('admin/services/create')}}" class="btn btn-success">Tambah Jasa</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th width="5%">Gambar</th>
                        <th>Harga Service</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td><img src="{{asset($data->image)}}" class="img-fluid"> </td>
                        <td>{{$data->service_price}}</td>
                        <td>
                            <a href="{{url('admin/services/show/' .$data->id)}}"
                                class="btn btn-sm btn-success text-white">Add Item</a>
                            <a href="{{url('admin/services/edit/' .$data->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="{{url('admin/services/delete/' .$data->id)}}"
                                class="btn btn-sm btn-danger text-white">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-12 mt-5">
        {{$services->links()}}
    </div>
</div>
@endsection
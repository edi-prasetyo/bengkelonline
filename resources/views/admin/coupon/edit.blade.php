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
            <h4>Edit Bank</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{url('admin/banks/'. $bank->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Name</label>

                        <input type="text" name="name" value="{{$brand->name}}" class="form-control">
                        @error('name') <small>
                            <div class="text-danger">{{$message}}</div>
                        </small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cabang</label>
                        <input type="text" name="branch" value="{{$brand->branch}}"
                            class="form-control @error('branch') is-invalid @enderror">
                        @error('branch')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Atas Nama</label>
                        <input type="text" name="account" value="{{$brand->account}}"
                            class="form-control @error('account') is-invalid @enderror">
                        @error('account')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Rekening</label>
                        <input type="number" name="number" value="{{$brand->number}}"
                            class="form-control @error('number') is-invalid @enderror">
                        @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="image" class="form-control">
                        <div class="col-md-4 my-3">
                            <img class="img-fluid" src="{{asset('/uploads/logo/' .$brand->bank_logo)}}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <label class="form-check-label">Status</label>
                                <input class="form-check-input" type="checkbox" name="status" {{$brand->status == '1'
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
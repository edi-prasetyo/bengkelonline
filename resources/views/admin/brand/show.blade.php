@extends('layouts.admin')

@section('content')


@if ($errors->any())
<div class="alert alert-warning">
    @foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
    @endforeach
</div>
@endif
<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-white">
            <h4>Merek {{$brand->name}}</h4>
        </div>
        <div class="card-body">

            <form action="{{url('admin/brands/add_model')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="brand_id" value="{{$brand->id}}">


                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check form-switch">
                        <label class="form-check-label">Status</label>
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                            name="status" checked>
                    </div>
                </div>


                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>


            </form>

        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="col-md-12">
            @if(session('message'))
            {!!session('message')!!}
            @endif
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th width="20%" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carModels as $key => $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>
                        <a href="" class="btn btn-danger btn-sm"> <i class="feather-trash  fa-fw"></i></a>
                        <a href="" class="btn btn-primary btn-sm"> <i class="feather-edit  fa-fw"></i></a>
                    </td>
                </tr>
                @endforeach



            </tbody>
        </table>
    </div>
</div>

@endsection
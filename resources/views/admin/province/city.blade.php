@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-header bg-white">
                Tambah Kota {{ $province->name }}
            </div>
            <div class="card-body">

                <form action="{{ url('admin/provinces/city') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="province_id" value="{{ $province->id }}">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-check-label">Status</label>
                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault" name="status" checked>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Kota</h4>

            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th width="35%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @if ($data->status == 1)
                                        <span class="badge bg-light-success text-success">Active</span>
                                    @else
                                        <span class="badge bg-light-danger text-danger">Inactive</span>
                                    @endif

                                </td>
                                <td>

                                    <a href="{{ url('admin/province/edit/' . $data->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{ $cities->links() }}
        </div>
    </div>
@endsection

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
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Data Stok {{ $service_item->name }}</h4>
                <a href="{{ url('admin/inventories/stock/create/' . $service_item->id) }}"
                    class="btn btn-success text-white">Tambah Stock</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th width="15%">Keterangan</th>
                            <th width="15%">Masuk</th>
                            <th width="15%">Keluar</th>
                            <th width="10%">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $data)
                            <tr>

                                <td>{{ $data->date }}</td>
                                <td> {{ $data->description }}</td>
                                <td> {{ $data->incoming }}</td>
                                <td> {{ $data->outcoming }}</td>
                                <td> {{ $data->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{ $inventories->links() }}
        </div>
    </div>
@endsection

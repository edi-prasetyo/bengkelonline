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
                <h4 class="my-auto">Data Stok Barang</h4>

            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nama Parts</th>
                            <th width="15%">Stok</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($service_items as $data)
                            <tr>

                                <td>{{ $data->name }}</td>


                                <td>
                                    @php
                                        $service_item = App\Models\Inventory::orderBy('id', 'desc')
                                            ->where('service_item_id', $data->id)
                                            ->first();
                                    @endphp
                                    {{ $service_item->stock }}
                                </td>

                                <td>
                                    <a class="btn btn-success text-white btn-sm"
                                        href="{{ url('admin/inventories/stock/' . $data->id) }}">
                                        View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{ $service_items->links() }}
        </div>
    </div>
@endsection

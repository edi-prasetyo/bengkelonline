@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h4>Create Brand</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ url('admin/inventories/stock/store/' . $service_item->id) }}" method="POST">
                        @csrf

                        {{-- <input type="hidden" name="service_item_id" value="{{ $service_item->id }}"> --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" value="{{ $service_item->name }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Barang Masuk</label>
                                    <input type="text" name="incoming" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Barang Masuk</label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

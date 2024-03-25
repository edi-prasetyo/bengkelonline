@extends('layouts.admin')

@section('content')
    <div class="row">
        @foreach ($services as $data)
            <div class="col-md-4">
                <a href="{{ url('admin/inventories/item/' . $data->id) }}">
                    <div class="card my-3">
                        <div class="card-body">
                            {{ $data->name }}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection

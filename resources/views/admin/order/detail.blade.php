@extends('layouts.admin')

@section('content')


<div class="row">
    @foreach($serviceItem as $item)
    <div class="col-md-3">
        <div class="card text-center">
            {{-- <img src="{{asset($item->image)}}" class="card-img-top img-fluid"> --}}
            <div class="card-body">
                <h5 class="card-title">{{$item->name}}</h5>
                <h3>IDR. {{number_format($item->price)}}</h3>
                <p class="card-text"><small class="text-body-secondary">Jasa Montir :
                        Rp. {{number_format($service->service_price)}}</small></p>
                <a href="{{ url('admin/orders/add-to-cart/'.$item->uuid) }}" class="btn btn-primary text-white">Tambah Item</a>
            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection
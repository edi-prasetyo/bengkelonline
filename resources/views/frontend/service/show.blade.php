@extends('layouts.app')
@include('layouts.inc.frontend.header')
@section('content')
<div class="container">
    <div class="col-md-8 mx-auto mb-3">
        @foreach($serviceItem as $item)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-3">
                    <img src="{{asset($item->image)}}" class="card-img-top img-fluid" alt="{{$service->name}}">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text">{{$item->description}}</p>
                        <h3>IDR. {{number_format($item->price)}}</h3>
                        <p class="card-text"><small class="text-body-secondary">Jasa Montir :
                                Rp. {{number_format($service->service_price)}}</small></p>

                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('add-to-cart/'.$item->uuid) }}" class="btn btn-outline-success text-center"
                        role="button"> <i class='bx bx-shopping-bag'></i> Tambah Item</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@extends('layouts.app')
@include('layouts.inc.frontend.header')
@section('content')
<div class="container">
    <div class="col-md-8 mx-auto mb-3">
        @foreach($serviceItem as $item)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9 col-12">
                        <div class="row">
                            <div class="col-md-4 col-4">
                                <img src="{{asset($item->image)}}" class="img-fluid rounded" alt="{{$service->name}}">
                            </div>
                            <div class="col-md-8 col-8">

                                <h5 class="card-title">{{$item->name}}</h5>
                                <small class="card-text">{{$item->description}}</small>
                                <h3>IDR. {{number_format($item->price)}}</h3>
                                <p class="card-text"><small class="text-body-secondary">
                                        @if($service->service_price == 0)

                                        @else
                                        Jasa Montir :
                                        Rp. {{number_format($service->service_price)}}</small></p>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 my-auto">
                        <div class="d-grid gap-2">
                            <a href="{{ url('add-to-cart/'.$item->uuid) }}" class="btn btn-outline-success text-center"
                                role="button"> <i class='bx bx-shopping-bag'></i> Tambah Item</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
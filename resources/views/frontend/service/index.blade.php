@extends('layouts.app')
@include('layouts.inc.frontend.header')
@section('content')

<div class="container">
    <div class="col-md-8 mx-auto mb-3">
        <div class="row">
            @foreach($services as $key => $service)


            <div class="col-md-3">
                <a href="{{url('services/'. $service->slug)}}" class="text-decoration-none">
                    <div class="card">
                        <img src="{{$service->image}}" class="card-img-top img-fluid" alt="{{$service->name}}">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$service->name}}</h5>
                            {{-- <p class="card-text"> Rp. {{number_format($service->price)}}</p> --}}

                        </div>
                    </div>
                </a>
            </div>

            @endforeach
        </div>

    </div>
</div>

@endsection
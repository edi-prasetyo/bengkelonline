@extends('layouts.app')
@include('layouts.inc.frontend.header')
@section('content')

<div class="container my-5">

    <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">

            @if(session('success'))
            <div class="col-md-12">
                <div class="alert alert-success d-flex justify-content-between align-items-start">
                    {{session('success')}}
                    <a href="{{url('cart')}}" class="btn btn-success">View Cart</a>
                </div>
            </div>
            @endif

            @forelse($products as $item)
            <div class="card shadow-0 border rounded-3 mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                            <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                <img src="{{asset($item->image_cover)}}" class="img-fluid rounded-start"
                                    alt="{{$item->name}}" class="w-100">

                                <a href="{{url('item/'.$item->slug)}}">
                                    <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <h5>{{$item->name}}</h5>
                            <div class="d-flex flex-row">
                                <div class="text-danger mb-1 me-2">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <span>310</span>
                            </div>
                            <div class="mt-1 mb-0 text-muted small">
                                <span>100% cotton</span>
                                <span class="text-primary"> • </span>
                                <span>Light weight</span>
                                <span class="text-primary"> • </span>
                                <span>Best finish<br /></span>
                            </div>
                            <div class="mb-2 text-muted small">
                                <span>Unique design</span>
                                <span class="text-primary"> • </span>
                                <span>For men</span>
                                <span class="text-primary"> • </span>
                                <span>Casual<br /></span>
                            </div>
                            <p class="text-truncate mb-4 mb-md-0">
                                There are many variations of passages of Lorem Ipsum available, but the
                                majority have suffered alteration in some form, by injected humour, or
                                randomised words which don't look even slightly believable.
                            </p>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                            <div class="d-flex flex-row align-items-center mb-1">
                                <h4 class="mb-1 me-1">{{number_format($item->price_product,0)}}</h4>
                                <span class="text-danger"><s>$20.99</s></span>
                            </div>
                            <h6 class="text-success">Free shipping</h6>
                            <div class="d-flex flex-column mt-4">
                                <button class="btn btn-primary btn-sm" type="button">Details</button>
                                <a href="{{ url('add-to-cart/'.$item->id) }}"
                                    class="btn btn-outline-primary btn-sm mt-2" type="button">
                                    Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @empty
            <div class="h-100">
                <div class="col-md-8 mx-auto my-auto">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="my-auto">No Products Available</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse


        </div>
    </div>
</div>

@endsection
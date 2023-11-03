@extends('layouts.app')
@section('title', 'Tag')
@section('content')
@include('layouts.inc.frontend.header')
<div class="container my-3">
    <h4>Tag : {{$tag->name}}</h4>
    <div class="row">
        @if(session('success'))
        <div class="col-md-12">
            <div class="alert alert-success d-flex justify-content-between align-items-start">
                {{session('success')}}
                <a href="{{url('cart')}}" class="btn btn-success">View Cart</a>
            </div>
        </div>
        @endif
        @forelse($tagProduct as $item)
        <div class="col-md-3">
            <div class="card rounded">
                <img src="{{asset($item->image_cover)}}" class="card-img-top rounded-bottom-0" alt="{{$item->name}}">
                <div class="card-body">
                    <a href="{{url('item/'.$item->slug)}}" class="text-muted">
                        <h5 class="card-title">{{$item->name}}</h5>
                    </a>
                    <h5>IDR {{number_format($item->price,0)}}</h5>
                </div>
                <div class="card-footer bg-transparent">

                    <div class="col">
                        <a href="{{ url('add-to-cart/'.$item->id) }}" class="btn btn-outline-success text-center"
                            role="button"> <i class='bx bx-shopping-bag'></i> Add to cart</a>

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
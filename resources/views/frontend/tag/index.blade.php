@extends('layouts.app')
@section('title', 'Category')
@section('content')
@include('layouts.inc.frontend.header')
<div class="container my-5">

    <div class="row">
        @forelse($tags as $tag)
        <div class="col-md-4">
            <div class="card text-center mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{$tag->name}}</h5>
                    <a href="{{url('tags/'.$tag->slug)}}" class="btn btn-primary">Show Product</a>
                </div>
            </div>
        </div>
        @empty
        <div class="h-100">
            <div class="col-md-8 mx-auto my-auto">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="my-auto">No Categoy Available</div>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

@endsection
@extends('layouts.app')
@section('title', 'Products')
@section('content')
@include('layouts.inc.frontend.header')
<div class="container my-3">
    <div class="col-md-10 mx-auto">
        @if(session('success'))
        <div class="col-md-12">
            <div class="alert alert-success d-flex justify-content-between align-items-start">
                {{session('success')}}
                <a href="{{url('cart')}}" class="btn btn-success">View Cart</a>
            </div>
        </div>
        @endif

        <div class="row">
            <h1 class="card-title mb-3">{{$product->name}}</h1>
            <div class="d-flex mb-5 text-muted">
                <div class="me-3">
                    <i class='bx bx-purchase-tag'></i> Script
                </div>
                <div class="ms-3">
                    <i class='bx bx-cart'></i> Terjual 342
                </div>
                <div class="ms-3">
                    <i class='bx bx-user'></i> 1756 views
                </div>
            </div>
            <div class="col-md-8">
                <img src="{{asset($product->image_cover)}}" class="img-fluid w-100 rounded-4">

                {{-- Nav Tabs Start --}}

                <nav class="mt-5">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active text-muted" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Product Detail</button>
                        {{-- <button class="nav-link text-muted" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false"><i class='bx bx-star'></i> Reviews 4.5 <span
                                class="badge bg-success ms-3">2134</span>
                        </button> --}}
                        <button class="nav-link text-muted" id="nav-gallery-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-gallery" type="button" role="tab" aria-controls="nav-gallery"
                            aria-selected="false"><i class='bx bx-image'></i> Gallery
                        </button>
                        <button class="nav-link text-muted" id="nav-contact-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-gallery" type="button" role="tab" aria-controls="nav-contact"
                            aria-selected="false"><i class='bx bx-comment'></i> Comments <span
                                class="badge bg-success ms-3">2134</span>
                        </button>
                    </div>
                </nav>
                <div class="tab-content p-3 bg-white border-start border-end border-bottom" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        {{$product->description}}
                    </div>
                    {{-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        ...
                    </div> --}}
                    <div class="tab-pane fade" id="nav-gallery" role="tabpanel" aria-labelledby="nav-gallery-tab"
                        tabindex="0">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary">
                            Launch demo modal
                        </button>




                        <div class="row">
                            @foreach($images as $key => $image)
                            <div class="col-md-6 mb-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$image->id}}"> <img
                                        class="img-fluid" src="{{asset($image->image)}}"></a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$image->id}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">

                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="img-fluid rounded w-100" src="{{asset($image->image)}}">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                        tabindex="0">

                        <div class="alert alert-success">Komentar anda akan di balas paling lambat 1x 24 Jam</div>
                        <form action="" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-3">
                                    <input type="text" name="name" placeholder="Nama..." class="form-control">
                                </div>
                                <div class="col-md-6 my-3">
                                    <input type="email" name="email" placeholder="Email" class="form-control">
                                </div>
                                <div class="col-md-12 my-3">
                                    <textarea type="text" name="message" class="form-control"
                                        placeholder="Pesan"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success"><i class='bx bxs-send'></i> Kirim
                                        Komentar</button>
                                </div>
                            </div>

                        </form>

                        <h4 class="my-3"><i class='bx bx-comment'></i> 234 Komentar</h4>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-start">
                                <div><i class='bx bx-user'></i> nama</div>
                                <div>
                                    <i class='bx bx-calendar'></i> 18 jan 2023
                                </div>
                            </div>
                            <div class="card-body">
                                Halloo
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h3>IDR {{number_format($product->price, 0)}}</h3>
                    </div>
                    <div class="card-body">
                        <h5>Ketentuan</h5>
                        <ul>
                            <li>Free Instalasi</li>
                            <li>Harga Belum termasuk Hosting/Server dan Domain</li>
                            <li>Penambahan Fitur akan di kenakan biaya</li>
                            <li>Garansi 2 Bulan</li>
                        </ul>
                        <h5>Framework</h5>
                        <p>Codeigniter 3.X.X, Bootstrap 5.x.x</p>
                        <h5>Tags</h5>
                        <p>
                            @foreach($tags as $key => $tag)
                            <a href="{{url('tags/'.$tag->tagslug)}}"> <span class="badge bg-label-success">
                                    {{$tag->tagname}}</span></a>
                            @endforeach

                        </p>

                        <div class="d-grid gap-2">

                            <a href="{{ url('add-to-cart/'.$product->id) }}"
                                class="btn btn-primary btn-rounded text-center fs-5" role="button">
                                <i class='bx bxs-cart'></i> Add to cart</a>
                            <a href="{{ url('add-to-cart/'.$product->id) }}"
                                class="btn btn-success btn-rounded text-center fs-5" role="button">
                                <i class='bx bx-server'></i> Live Demo</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Nav Tabs End --}}


        </div>
    </div>
</div>




@endsection
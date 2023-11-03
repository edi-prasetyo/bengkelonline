@extends('layouts.app')
@section('title', 'Booking Bengkel Online')
@section('content')
@include('layouts.inc.frontend.header')
<div class="container">
    <div class="col-sm-8 col-lg-5 mx-auto my-5">
        <div class="card shadow">
            <div class="card-header bg-white border-0 py-3">
                <h4> Contact Us </h4>
            </div>
            <div class="card-body px-4">

                <h4 class="footer-heading">Alamat</h4>
                <div class="footer-underline"></div>
                <div class="mb-2">
                    <p>
                        <i class='bx bxs-map'></i>
                        {{$option_nav->address}}
                    </p>
                </div>
                <div class="mb-2">

                    <i class='bx bx-phone'></i> {{$option_nav->phone}}

                </div>
                <div class="mb-2">

                    <i class='bx bxl-whatsapp'></i> {{$option_nav->whatsapp}}

                </div>
                <div class="mb-2">

                    <i class='bx bx-envelope'></i> {{$option_nav->email}}

                </div>


            </div>
        </div>
    </div>
</div>
@endsection
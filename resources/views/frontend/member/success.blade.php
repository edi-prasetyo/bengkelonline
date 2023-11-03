@extends('layouts.app')
@section('content')
@include('layouts.inc.frontend.header')

<div class="container">
    <div class="col-md-8 mx-auto">

        <h1 class="display-1 text-success"><i class='bx bx-check-circle'></i></h1>
        <h2>Permintaan Berhasil Terkirim</h2>

        Silahkan melakukan pembayaran Untuk Proses topup
        <div class="row">
            @foreach($banks as $key => $bank)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="">
                                <img src="{{asset('uploads/logo/' .$bank->bank_logo)}}" alt="Credit Card" width="45%"
                                    height="auto">
                            </div>

                        </div>
                        <span>{{$bank->name}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$bank->number}}</h3>
                        <small class="text-success fw-semibold"><i class='bx bx-user'></i>
                            {{$bank->account}}</small>
                    </div>
                </div>

            </div>
            @endforeach
        </div>


        <a href="{{url('member/topup/')}}" class="btn btn-success my-3">Konfirmasi Pembayaran</a>
    </div>
</div>

@endsection
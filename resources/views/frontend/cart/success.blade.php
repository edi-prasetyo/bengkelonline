@extends('layouts.app')
@section('title', 'Cart')
@include('layouts.inc.frontend.header')
@section('content')

<div class="container mb-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="mt-5 text-center">
                    <h1 class="display-1 text-success"><i class='bx bx-check-circle'></i></h1>
                    <h2>Order Berhasil Dibuat</h2>
                    <span class="font-weight-bold d-block mt-4">Hello, {{$order->full_name }}</span>
                    <span>Pesanan Anda telah dikonfirmasi, Silahkan melakukan Pembayaran Untuk Proses Lebih
                        Lanjut!</span>
                </div>
                <div class="invoice p-5">

                    <div class="row">
                        <hr>
                        <div class="col-md-4 col-4">
                            <div class="d-block text-muted">Tanggal Order</div>
                            <span>{{date('d M Y', strtotime($order->created_at))}}</span>
                        </div>
                        <div class="col-md-4 col-4">
                            <div class="d-block text-muted">No Invoice</div>
                            <span>{{$order->invoice}}</span>
                        </div>
                        <div class="col-md-4 col-4">
                            <div class="d-block text-muted">Pembayaran</div>
                            <span>
                                @if($order->payment_status == 0)
                                <span class="badge bg-label-danger">Unpaid</span>
                                @else
                                Lunas
                                @endif

                            </span>
                        </div>

                    </div>
                    <hr>

                    @php $total = 0 @endphp
                    <div class="row">
                        @foreach($order_items as $key => $item)
                        @php $total += $item->service_price+$item->price @endphp
                        <div class="col-md-6 col-6">
                            <div class="fw-bold"> {{$item->name}}</div>
                            <div class="fw-bold"> Jasa Mekanik</div>
                        </div>
                        <div class="col-md-6 col-6 text-end">
                            {{number_format($item->price)}}<br>
                            {{number_format($item->service_price)}}
                        </div>
                        <hr>
                        @endforeach
                    </div>
                    <div class="row">

                        <div class="col-md-6 col-6 text-end">

                        </div>
                        <div class="col-md-6 col-6 text-end">
                            <span class="pe-5">Subtotal </span>
                            <span class="fw-bold"> {{number_format($total)}}</span>
                        </div>
                    </div>


                    <p class="mt-5">Order anda sudah di buat Silahkan Melakukan Pembayaran dengan Mengklik Tombol di
                        bawah ini</p>
                    <a href="{{url('payment/' .$order->code)}}" class="btn btn-primary"> Bayar Sekarang</a>
                    <a href="{{url('orders/pdf/' .$order->code)}}" class="btn btn-success">Download Pdf</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
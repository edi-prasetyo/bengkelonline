@extends('layouts.app')

@section('content')
@include('layouts.inc.frontend.header')

<div class="container">
    <div class="row m-0">
        <div class="col-md-3">
            @include('frontend.member.sidebar')
        </div>
        <div class="col-md-9">


            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body row">
                            <div class="col-md-8">
                                <p class="textmuted fw-bold h6 mb-0">Total Payment</p>
                                <p class="h1 fw-bold d-flex"> <span
                                        class=" fas fa-dollar-sign textmuted pe-1 h6 align-text-top mt-1"></span>{{number_format($order_detail->amount)}}
                                </p>
                                @if($order_detail->status == 0)
                                <p>Pesanan Anda Belum di Bayar Silahkan melakukan Pembayaran</p>
                                <p class="badge bg-danger bg-opacity-75">Unpaid</p><br>
                                <a href="{{url('payment/'. $order_detail->code)}}" class="btn btn-primary">Bayar
                                    Sekarang</a>
                                @elseif($order_detail->status == 1)
                                <div class="alert alert-warning mt-3">
                                    Pembayaran Anda Masih Menunggu Proses Pengecekan, Silahkan Hubungi Admin melalui
                                    chat
                                    whatsapp di nomor di bawah ini
                                </div>
                                @else
                                <p class="ms-3 px-2 badge bg-success bg-opacity-75">Success</p>
                                @endif

                            </div>
                            <div class="col-md-4">
                                <p class="p-blue"> <span class="fas fa-circle pe-2"></span>Nomor Invoice </p>
                                <p class="fw-bold mb-3">#{{$order_detail->invoice_number}}</p>
                                Tanggal Order : <span class="text-danger">{{date('d M Y',
                                    strtotime($order_detail->created_at))}}</span>
                                <br>

                                @if($order_detail->status == 0)
                                <span class="badge bg-label-danger">Pending</span>
                                @elseif($order_detail->status == 1)
                                <span class="badge bg-label-warning">Proses</span>
                                @else
                                <span class="badge bg-label-success">Selesai</span>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th> Status</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach($product_items as $key => $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <div class="d-flex flex-column">
                                                    <span class="fw-semibold lh-1">{{$product->product_name}}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="lh-1"><span class="text-primary fw-semibold">Rp.
                                                    {{number_format($product->product_price)}}</span></div>

                                        </td>
                                        <td>
                                            @if($order_detail->status == 0)
                                            <span class="badge bg-label-danger">Pending</span>
                                            @elseif($order_detail->status == 1)
                                            <span class="badge bg-label-warning">Proses</span>
                                            @else
                                            <span class="badge bg-label-success">Selesai</span>
                                            @endif

                                        </td>
                                        <td>

                                            @if($order_detail->payment_status == 0)
                                            <a href="#" class="btn btn-label-danger disabled" disabled>
                                                <span class="tf-icons bx bx-pie-chart-alt me-1"></span> Download
                                            </a>
                                            @else
                                            <a href="{!! url('member/directory/9f37359d-79bf-4a20-ae3e-a282d709d909/file/'. $product->file_download) !!}"
                                                download="{{$product->file_download}}" class="btn btn-label-primary">
                                                <span class="tf-icons bx bx-pie-chart-alt me-1"></span> Download
                                            </a>
                                            @endif


                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>



























        </div>
    </div>
    @endsection
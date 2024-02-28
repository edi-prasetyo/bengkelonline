@extends('layouts.admin')

@section('content')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            header,
            .card-header,
            #sidebar-wrapper {
                display: none !important;
            }

            #reportArea,
            #reportArea * {
                visibility: visible;
            }

            #reportArea {
                right: 0;
                padding: 0;
                left: 0;
                top: 0;
                width: 100%;
            }

        }
    </style>


    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-white noPrint">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="custom-actions-btns">
                            <a href="{{ url('admin/orders/download/' . $order->id) }}" class="btn btn-danger text-white">
                                <i class="fa fa-download"></i> Download Pdf
                            </a>
                            <button onclick="window.print();" class="noPrint btn btn-secondary text-white"><i
                                    class="fa fa-print"></i> Print</button>

                        </div>
                    </div>
                </div>
                <div id="reportArea">
                    <div class="card-body">
                        <div class="invoice-container">
                            <div class="invoice-header">
                                <!-- Row start -->
                                <div class="row gutters">

                                </div>
                                <!-- Row end -->
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                        <a href="index.html" class="invoice-logo">
                                            <img width="70%" class="img-fluid"
                                                src="{{ asset('uploads/logo/' . $option_nav->logo) }}">
                                        </a>

                                        <p class="mt-2"><i class="fa-solid fa-location-dot"></i>
                                            {{ $option_nav->address }}<br>
                                            <i class="fa-solid fa-phone"></i> {{ $option_nav->whatsapp }}<br>
                                            <i class="fa-solid fa-envelope-circle-check"></i> {{ $option_nav->email }}<br>
                                            <i class="fa-solid fa-globe"></i> {{ $option_nav->link }}<br>
                                        </p>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 text-center">
                                        <h1>INVOICE</h1>
                                        @php
                                            $invoice = str_pad($order->id, 6, '0', STR_PAD_LEFT);
                                        @endphp
                                        <h4> NO : {{ $invoice }}</h4>
                                        <p>
                                            @if ($order->home_service == 0)
                                                Servis di bengkel
                                            @else
                                                Servis Di rumah <br>
                                                {{ $order->city }}<br>
                                                {{ $order->address }}
                                            @endif

                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 text-end">
                                        Nama : {{ $order->full_name }}<br>
                                        Hp/Whatsapp : {{ $order->phone_number }}<br>
                                        Tanggal Servis : {{ $order->schedule_date }}<br>
                                        Jam : {{ $order->schedule_time }} WIB<br><br>
                                    </div>
                                </div>
                                <!-- Row end -->
                                <!-- Row start -->

                                <!-- Row end -->
                            </div>
                            <div class="invoice-body">
                                <!-- Row start -->
                                <div class="row gutters">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Item Service</th>
                                                        <th>Harga</th>
                                                        <th>Quantity</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order_items as $item)
                                                        <tr>
                                                            <td>
                                                                {{ $item->name }}
                                                            </td>
                                                            <td>
                                                                Rp. {{ number_format($item->price) }}
                                                            </td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>Rp. {{ number_format($item->price) }}</td>
                                                        </tr>
                                                    @endforeach


                                                    <tr>

                                                        <td
                                                            style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                            &nbsp;</td>
                                                        <td
                                                            style="border-left: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                            &nbsp;</td>
                                                        <td colspan="1">
                                                            Diskon
                                                        </td>
                                                        <td>
                                                            Rp. 0
                                                        </td>
                                                    </tr>

                                                    <tr>

                                                        <td
                                                            style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                            &nbsp;</td>
                                                        <td
                                                            style="border-left: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                            &nbsp;</td>
                                                        <td colspan="1">
                                                            <span class="fw-bold">Grand Total</span>
                                                        </td>
                                                        <td>
                                                            <strong>{{ number_format($order->grand_total) }}</strong>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 text-center">
                                        Hormat Kami,<br><br><br><br><br><br><br><br><br>




                                        (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
                                    </div>
                                </div>
                                <!-- Row end -->
                            </div>
                            <div class="card-footer bg-white py-3 text-center mt-5">
                                Terima Kasih Telah menggunakan
                                jasa layanan Kami
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>









    {{-- <div class="row">
    <div class="col-12 mb-4">
        @if (session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
        @endif
        <div class="card shadow-sm border-0">
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="ps-3 textmuted fw-bold h6 mb-0">Total Payment</p>
                            <p class="h1 fw-bold d-flex"> <span
                                    class=" fas fa-dollar-sign textmuted pe-1 h6 align-text-top mt-1"></span>{{number_format($order->grand_total)}}
                            </p>
                            @if ($order->status == 0)
                            <span class="badge bg-danger">Pending</span>
                            @elseif($order->status == 1)
                            <span class="badge bg-warning">Proses</span>
                            @else
                            <span class="badge bg-success">Selesai</span>
                            @endif

                            <div class="mt-3">
                                @if ($order->status == 0)

                                @elseif($order->status == 1)

                                <form action="{{url('admin/orders/confirmation/' .$order->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="payment_status" value="1">
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                </form>
                                @else

                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            @if ($order->status == 0)

                            @elseif($order->status == 1)
                            <img class="img-fluid" src="{{asset('uploads/struk/'.$order->struk)}}">
                            @else
                            <img class="img-fluid" src="{{asset('uploads/struk/'.$order->struk)}}">
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <p class="p-blue"> <span class="fas fa-circle pe-2"></span>Nomor Invoice </p>
                    <p class="fw-bold mb-3">#{{$order->invoice_number}}</p>
                    Tanggal Order : <span class="text-danger">{{date('d M Y',
                        strtotime($order->created_at))}}</span>

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
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th> Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($order_items as $key => $order)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold lh-1">{{$order->service_name}}</span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="lh-1"><span class="text-primary fw-semibold">Rp.
                                        {{number_format($order->service_price)}}</span></div>
                                <small class="text-muted">Lunas</small>
                            </td>
                            <td><span class="badge bg-label-success">Completed</span></td>
                            <td>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div> --}}
@endsection

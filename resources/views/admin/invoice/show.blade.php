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
                            <a href="{{ url('admin/invoices/download/' . $invoice->id) }}" class="btn btn-danger text-white">
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
                                            $invoice_num = str_pad($invoice->id, 6, '0', STR_PAD_LEFT);
                                        @endphp
                                        <h4> NO : {{ $invoice_num }}</h4>

                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 text-end">
                                        Nama : {{ $invoice->customer_name }}<br>
                                        Tanggal Invoice : {{ date('d-m-Y', strtotime($invoice->invoice_date)) }}<br>

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

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($invoice_item as $item)
                                                        <tr>

                                                            <td>
                                                                {{ date('d M Y', strtotime($item->order_date)) }} <br>
                                                                {{ $item->car_brand }}
                                                                {{ $item->car_model }} -
                                                                {{ $item->car_number }} <br>

                                                                @php $orders =  App\Models\OrderItem::where('order_id', $item->order_id)->get(); @endphp
                                                                @foreach ($orders as $order)
                                                                    <ul>
                                                                        <li>
                                                                            {{ $order->name }} -
                                                                            Rp. {{ number_format($order->price) }} x
                                                                            {{ $order->quantity }}
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                Rp. {{ number_format($item->total) }}
                                                            </td>



                                                        </tr>
                                                    @endforeach


                                                    <tr>

                                                        <td class="text-end"
                                                            style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                            &nbsp; Total</td>

                                                        <td>
                                                            Rp. {{ number_format($invoice->total) }}
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td class="text-end"
                                                            style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                            &nbsp; Down Payment</td>

                                                        <td>
                                                            Rp. {{ number_format($invoice->down_payment) }}
                                                        </td>
                                                    </tr>

                                                    <tr>

                                                        <td class="text-end"
                                                            style="border-left: 0px solid Transparent!important;border-right: 0px solid Transparent!important;border-bottom: 1px solid Transparent!important;">
                                                            &nbsp; Grand Total</td>

                                                        <td>
                                                            <strong>Rp. {{ number_format($invoice->grand_total) }}</strong>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
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
@endsection

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
        body {
            font-family: system-ui, system-ui, sans-serif;
        }

        table {
            border-spacing: 0;
        }

        table td,
        table th,
        p {
            font-size: 13px !important;
        }

        img {
            /* border: 3px solid #F1F5F9; */
            padding: 6px;
            /* background-color: #F1F5F9; */
        }

        .table-no-border {
            width: 100%;
        }


        .table-no-border .width-70 {
            width: 70%;
            text-align: left;
        }

        .table-no-border .width-30 {
            width: 30%;
        }

        .margin-top {
            margin-top: 40px;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            /* background-color: #f2f2f2; */
        }

        #customers tr:hover {
            /* background-color: #ddd; */
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #60A5FA;
            color: white;
        }

        #signature td,
        #signature th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;

        }

        #signature th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #fff;
            color: #333;
        }

        .flex-container {
            display: flex;
        }

        .flex-container>div {
            background-color: #f1f1f1;
            margin: 10px;
            padding: 20px;
            width: 50%;
        }
    </style>
</head>

<body>

    <table width="100%">
        <tbody>
            <tr>
                <td>
                    <img style="width: 30%" src="https://bengkelonline.com/uploads/logo/1699522071.png" />
                </td>
                <td style="float:right;text-align-right">
                    @php
                        $invoice = str_pad($order->id, 6, '0', STR_PAD_LEFT);
                    @endphp
                    <p style="font-size: 20px"><b>NO. INVOICE : {{ $invoice }}</b></p>
                    <small>Order ID : {{ $order->invoice }}</small>
                </td>
            </tr>
        </tbody>
    </table>

    <hr>

    <table width="100%">
        <tbody>
            <tr>
                <td width="40%" style="padding-right: 10px">

                    Bengkel<br>

                    <strong> {{ $option_nav->title }}</strong><br>
                    Alamat : <address>
                        {{ $option_nav->address }}
                    </address><br>
                    Phone: {{ $option_nav->whatsapp }}<br>
                    Email: {{ $option_nav->email }}


                </td>
                <td width="40%" style="padding-left: 10px; float-right;text-align-right">


                    Pelanggan <br>
                    <strong>{{ $order->full_name }}</strong><br>
                    Alamat : <address> {{ $order->address }}</address> <br>
                    Kota : {{ $order->city }} <br>
                    Phone: {{ $order->phone_number }} <br>


                </td>
            </tr>
        </tbody>
    </table>


    <table width="100%">
        <tbody>
            <tr>
                <td style="padding: 3px">

                    <h3>Detail Kendaraan</h3>
                    {{ $order->brand }} {{ $order->model }} {{ $order->platnumber }} - {{ $order->year }} <br>
                    Odometer : <b>{{ number_format($order->kilometer) }} km </b> <br>
                    Tanggal Servis : <b> {{ date('d M Y', strtotime($order->schedule_date)) }}</b>

                </td>
                <td style="padding: 3px">


                </td>
            </tr>
        </tbody>
    </table>




    <div style="margin-top:15px;">



        <table id="customers">
            <thead>
                <tr>
                    <th width="35%">Item Servis</th>
                    <th width="20%">Harga</th>
                    <th width="20%">Qty</th>
                    <th width="25%">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $item)
                    <tr>
                        <td>{{ $item->service_name }} - {{ $item->name }} </td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            @php $total = $item->price * $item->quantity @endphp
                            Rp. {{ number_format($total) }} </td>
                    </tr>
                @endforeach
                <!-- Down Payment -->

                {{-- <tr>
                    <td colspan="1" style="border-left:hidden"></td>
                    <td>Uang Muka :</td>
                    <td>Rp. </td>
                </tr> --}}


                <!-- End Down Payment -->
                <tr>
                    <td colspan="2" style="border-bottom: hidden;  border-left:hidden"></td>
                    <td>Down Payment:</td>
                    <td><b style="color:red"> - Rp. {{ number_format($order->down_payment) }}</b> </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: hidden;  border-left:hidden"></td>
                    <td>Grand Total:</td>
                    <td><b style="color:green">Rp. {{ number_format($order->grand_total) }}</b> </td>
                </tr>

            </tbody>
        </table>

        <h5>Note :</h5>
        Pembayaran Transfer melalui Rekening : <br>
        @foreach ($banks as $bank)
            <b>{{ $bank->name }} {{ $bank->number }}</b><br>
            {{ $bank->account }}
        @endforeach
        {{-- <div style="margin-top:50px;"></div>
        <div style="text-align:center;margin:0 auto">
            <h5> Hormat Kami</h5>
            <table id="signature" width="100%">
                <tbody>
                    <tr>
                        <th>Kepala Bengkel</th>
                        <th>Finance</th>
                        <th>Direktur</th>
                    </tr>
                    <tr>

                        <td width="33%" style="padding: 3px;position: relative;height:70px;text-align:center;">



                            <div style="position: absolute;bottom: 7px;left: 0;right: 0;"><b> Kiki </b></div>
                        </td>
                        <td width="33%" style="padding: 3px;position: relative;height:70px;text-align:center;">




                            <div style="position: absolute;bottom: 7px;left: 0;right: 0;"><b>Dyah</b></div>
                        </td>
                        <td width="33%" style="padding: 3px;position: relative;height:70px;text-align:center;">




                            <div style="position: absolute;bottom: 7px;left: 0;right: 0;">
                                <b> Salim Santoso</b>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> --}}
    </div>

</body>

</html>

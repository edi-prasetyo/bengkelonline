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
                        $invoice_num = str_pad($invoice->id, 6, '0', STR_PAD_LEFT);
                    @endphp
                    <b>NO. INVOICE : {{ $invoice_num }}</b><br>
                    Payment Status : @if ($invoice->payment_status == 0)
                        <span style="color:red">Unpaid</span>
                    @else
                        <span style="color:green">Paid</span>
                    @endif
                    <br>
                    Invoice Date : {{ date('d-m-Y', strtotime($invoice->invoice_date)) }}

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
                    <strong>{{ $invoice->customer_name }}</strong><br>
                    Alamat : <address> {{ $invoice->customer_address }}</address> <br>
                    Kota : {{ $invoice->customer_city }} <br>
                    Phone: {{ $invoice->customer_whatsapp }} <br>


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

                </tr>
            </thead>
            <tbody>
                @foreach ($invoice_items as $item)
                    <tr>
                        <td>
                            {{ date('d M Y', strtotime($item->order_date)) }} <br>
                            {{ $item->car_brand }} {{ $item->car_model }} -
                            {{ $item->car_number }} <br>

                            @php $orders =  App\Models\OrderItem::where('order_id', $item->order_id)->get(); @endphp
                            @foreach ($orders as $order)
                                <ul>
                                    <li>
                                        {{ $order->service_name }} {{ $order->name }} -
                                        Rp. {{ number_format($order->price) }} x
                                        {{ $order->quantity }}
                                    </li>
                                </ul>
                            @endforeach

                        </td>
                        <td> Rp. {{ number_format($item->total) }}</td>


                    </tr>
                @endforeach

                <tr>
                    <td style="border-bottom: hidden;  border-left:hidden;text-align:right">Down Payment:</td>

                    <td><b style="color:red"> - Rp. {{ number_format($invoice->down_payment) }}</b> </td>
                </tr>
                <tr>
                    <td style="border-bottom: hidden;  border-left:hidden;text-align:right">Grand Total:</td>

                    <td><b style="color:green">Rp. {{ number_format($invoice->grand_total) }}</b> </td>
                </tr>

            </tbody>
        </table>



        <div style="margin-top:50px;"></div>
        <div style="text-align:center;margin:0 auto">

            <table width="100%">
                <tbody>

                    <tr>
                        <td width="50%" style="padding: 3px;position: relative;height:150px;text-align:center;">
                            <h5>Note :</h5>
                            Pembayaran Transfer melalui Rekening : <br>
                            @foreach ($banks as $bank)
                                <b>{{ $bank->name }} {{ $bank->number }}</b><br>
                                {{ $bank->account }}
                            @endforeach

                            <div style="position: absolute;bottom: 7px;left: 0;right: 0;"><b></b></div>
                        </td>
                        <td width="50%" style="padding: 3px;position: relative;height:150px;text-align:center;">
                            <h5> Hormat Kami</h5>

                            <img width="30%" src="https://bengkelonline.com/uploads/logo/stamp-signature.png">

                            <div style="position: absolute;bottom: 0;left: 0;right: 0;">
                                <b> Salim Santoso</b>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>

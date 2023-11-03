@extends('layouts.app')
@section('title', 'Payment')
@include('layouts.inc.frontend.header')
@section('content')

<div class="container">
    <div class="col-md-6 mx-auto">

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body row">
                <div class="col-md-8">
                    <p class="textmuted fw-bold h6 mb-0">Total Payment</p>
                    <p class="h1 fw-bold d-flex"> <span
                            class=" fas fa-dollar-sign textmuted pe-1 h6 align-text-top mt-1"></span>{{number_format($order->amount)}}
                    </p>
                    Tanggal Order : <span class="text-danger">{{date('d M Y',
                        strtotime($order->created_at))}}</span><br>




                </div>
                <div class="col-md-4">
                    <p class="p-blue"> <i class='bx bxs-circle text-primary'></i> Nomor Invoice </p>
                    <p class="fw-bold mb-3">#{{$order->invoice_number}}</p>

                    @if($order->payment_status == 0)
                    <div class="badge bg-label-danger">Belum Dibayar</div>
                    @else
                    <div class="badge bg-label-success">Lunas</div>
                    @endif

                </div>
            </div>

        </div>

        @if($order->status == 0)
        <div class="alert alert-success">
            Silahkan Transfer Pembayaran melalui Nomor Rekening Di Bawah ini<br>
            <ul class="list-group">
                @foreach($banks as $key => $bank)

                <li class="list-group-item d-flex justify-content-between align-items-start">

                    <div class="ms-2 me-auto d-flex">
                        <div class="col-md-3">
                            <img src="{{asset('uploads/logo/'.$bank->bank_logo)}}" class="img-fluid">
                        </div>
                        <div>
                            <div class="fw-bold fs-3">{{$bank->number}}
                            </div>
                            <p>A.n {{$bank->account}}</p>
                        </div>

                    </div>
                    <span class="badge bg-primary rounded-pill">{{$bank->name}}</span>
                </li>

                @endforeach
            </ul>

        </div>

        <h3>Upload Bukti Transfer</h3>


        <form action="{{url('member/struk')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="order_id" value="{{$order->id}}">
            <div class="mb-3">
                <label for="formFile" class="form-label">Pilih Struk Bukti Transfer</label>
                <input class="form-control" type="file" name="struk" id="formFile">
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>

        </form>

        @elseif($order->status == 1)

        <div class="alert alert-warning mt-3">
            Pembayaran Anda Masih Menunggu Proses Pengecekan, Silahkan Hubungi Admin melalui chat
            whatsapp di nomor di bawah ini
        </div>
        <div class="img-fluid my-3"> <img class="img-fluid" src="{{asset('uploads/struk/' .$order->struk)}}"></div>
        @else

    </div>
    @endif
</div>

@endsection
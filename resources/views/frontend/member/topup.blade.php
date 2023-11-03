@extends('layouts.app')
@section('content')
@include('layouts.inc.frontend.header')

<div class="container mb-5">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.member.sidebar')
        </div>
        <div class="col-md-7">
            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            @if($pending_topup == "")

            <div class="card">
                <div class="card-header">
                    Topup
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{url('member/wallets')}}" method="POST">
                            @csrf
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Jumlah Topup <span class="text-danger">Min
                                        50.000</span></label>
                                <input type="number" class="form-control" name="amount"
                                    placeholder="Masukan Jumlah Topup" min="50000" max="50000000000">
                            </div>

                            <div class="col-md-8">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" value="Kirim">Kirim</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            @else

            <div class="card">
                <div class="card-header">
                    Anda Masih Memiliki Top Up yang belum di Bayar
                </div>
                <div class="card-body">
                    <div class="fw-bold fs-2">
                        Rp. {{number_format($pending_topup->amount)}}
                    </div>

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
                    @if($pending_topup->struk == null)

                    <form action="{{url('member/struk')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="topup_id" value="{{$pending_topup->id}}">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Pilih Struk Bukti Transfer</label>
                            <input class="form-control" type="file" name="struk" id="formFile">
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>

                    </form>

                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-warning">
                                Pembayaran Anda Masih Menunggu Proses Pengecekan, Silahkan Hubungi Admin melalui chat
                                whatsapp di nomor di bawah ini

                            </div>
                        </div>
                        <div class="col-md-6">
                            <img class="img-fluid" src="{{asset('uploads/struk/' .$pending_topup->struk)}}">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif


        </div>
    </div>
</div>

@endsection
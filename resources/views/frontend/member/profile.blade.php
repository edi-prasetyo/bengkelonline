@extends('layouts.app')
@section('content')
@include('layouts.inc.frontend.header')

<div class="container">
    <div class="col-md-8 text-center mx-auto">

        <h1 class="display-1 text-success"><i class='bx bx-check-circle'></i></h1>
        <h2>Top Up Berhasil</h2>
        <a href="{{url('member/wallets')}}" class="btn btn-success">Lihat Halaman Deposit</a>
    </div>
</div>

@endsection
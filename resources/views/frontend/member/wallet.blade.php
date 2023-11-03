@extends('layouts.app')

@section('content')
@include('layouts.inc.frontend.header')
<div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                @include('frontend.member.sidebar')
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card rounded-4 mb-3 bg-primary border-0 bg-opacity-75 text-white">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="media-body text-start">
                                            <span>Deposit</span>
                                            <h3 class="text-white">

                                                IDR. {{number_format($wallets->amount, 0)}}</h3>


                                            <small style="font-size: 10px">Deposit digunakan untuk membeli produk
                                                digital di
                                                Graha
                                                Studio
                                            </small>

                                        </div>
                                        <div class="align-self-center">
                                            <i
                                                class="bx bx-wallet text-primary-emphasis text-opacity-0 display-2 float-end"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{url('member/topup')}}">
                            <div class="card rounded-4 mb-3 bg-success border-0 bg-opacity-75 text-white">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="media-body text-start">
                                                <span>Tambah Deposit</span>
                                                <h3 class="">Topup</h3>
                                                <small> </small>

                                            </div>
                                            <div class="align-self-center">
                                                <i
                                                    class="bx bx-plus text-primary-emphasis text-opacity-0 display-2 float-end"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>


                <h3 class="my-3">Riwayat Deposit</h3>

                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th> Type</th>
                                    <th width="20%">Saldo</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($wallet_logs as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold lh-1">{{date('d M Y',
                                                    strtotime($data->created_at))}}</span>
                                                <small class="text-muted">{{date('H:i:s',
                                                    strtotime($data->created_at))}}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="lh-1"><span class="text-primary fw-semibold">

                                                @if($data->type == 'topup')
                                                <div class="text-success"><i class='bx bx-plus'></i> Rp.
                                                    {{number_format($data->amount)}}</div>
                                                @elseif($data->type == 'buy')
                                                <div class="text-danger"><i class='bx bx-minus'></i> Rp.
                                                    {{number_format($data->amount)}}</div>
                                                @else

                                                @endif

                                            </span></div>

                                    </td>
                                    <td>
                                        @if($data->type == 'topup')
                                        <div class="badge bg-label-success">{{$data->type}}</div>
                                        @elseif($data->type == 'buy')
                                        <div class="badge bg-label-danger">{{$data->type}}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-primary fw-semibold">
                                            @if($data->type == 'topup')
                                            <div class="text-success">{{number_format($data->balance)}}</div>
                                            @elseif($data->type == 'buy')
                                            <div class="text-danger">{{number_format($data->balance)}}</div>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Order Available </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>




        {{-- @forelse ($wallet_logs as $data)
        <div class="card rounded-4 mb-3 border-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{date('d M Y - H:i:s', strtotime($data->created_at))}}
                        <p>{!!$data->information!!}</p>
                    </div>
                    <div class="col-6 text-end">
                        @if($data->type == 'topup')
                        <div class="text-success">{{$data->type}}</div>
                        @elseif($data->type == 'buy')
                        <div class="text-danger">{{$data->type}}</div>
                        @endif
                        <h4> @if($data->type == 'topup')
                            <div class="text-success"><i class='bx bx-plus'></i> Rp.
                                {{number_format($data->amount)}}</div>
                            @elseif($data->type == 'buy')
                            <div class="text-danger"><i class='bx bx-minus'></i> Rp.
                                {{number_format($data->amount)}}</div>
                            @else

                            @endif
                        </h4>
                        Saldo Akhir
                        @if($data->type == 'topup')
                        <div class="text-success">{{number_format($data->balance)}}</div>
                        @elseif($data->type == 'buy')
                        <div class="text-danger">{{number_format($data->balance)}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse --}}
        <div class="col-md-12 my-3">
            {{$wallet_logs->links()}}
        </div>
    </div>
</div>
@endsection
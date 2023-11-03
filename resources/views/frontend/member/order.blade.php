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


                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Pembayaran</th>
                                    <th>Order Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">

                                @forelse ($orders as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold lh-1">{{$data->invoice_number}}</span>
                                                <small class="text-muted">{{$data->customer_name}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-label-warning rounded-pill badge-center p-3 me-2"><i
                                                class='bx bx-calendar'></i></span> {{date('d M Y',
                                        strtotime($data->created_at))}}</td>
                                    <td>
                                        <div class="lh-1"><span class="text-primary fw-semibold">Rp.
                                                {{number_format($data->amount)}}</span>
                                        </div>
                                        <small class="text-muted">Deposit Payment</small>
                                    </td>
                                    <td>
                                        @if($data->status == 0)
                                        <span class="badge bg-label-danger">Pending</span>
                                        @elseif($data->status == 1)
                                        <span class="badge bg-label-warning">Proses</span>
                                        @else
                                        <span class="badge bg-label-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('member/orders/detail/'. $data->code)}}"
                                            class="btn btn-label-primary">
                                            <span class="tf-icons bx bx-pie-chart-alt me-1"></span> Lihat
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-12 my-3">
            {{$orders->links()}}
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="row">
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
                            @if($order->status == 0)
                            <span class="badge bg-danger">Pending</span>
                            @elseif($order->status == 1)
                            <span class="badge bg-warning">Proses</span>
                            @else
                            <span class="badge bg-success">Selesai</span>
                            @endif

                            <div class="mt-3">
                                @if($order->status == 0)

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
                            @if($order->status == 0)

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
                        @foreach($order_items as $key => $order)
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
</div>
@endsection
@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        @if (session('message'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-start">
                <h4 class="my-auto">Data Global Invoice</h4>
                <a href="{{ url('admin/invoices/order') }}" class="btn btn-success text-white">Add Invoice</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Invoice</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th width="15%">Amount</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $data)
                            <tr>
                                @php
                                    $invoice = str_pad($data->id, 6, '0', STR_PAD_LEFT);
                                @endphp
                                <td>{{ $invoice }}</td>
                                <td>{{ $data->customer_name }}</td>

                                <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                <td>
                                    @if ($data->payment_status == 1)
                                        <i class="fa-solid fa-circle text-success" style="font-size: 7px;"></i> <span
                                            class="text-success">Paid</span>
                                    @else
                                        <i class="fa-solid fa-circle text-danger my-auto" style="font-size: 7px;"></i> <span
                                            class="text-danger">Unpaid</span>
                                    @endif
                                </td>
                                <td>Rp. {{ number_format($data->grand_total) }}</td>
                                <td>
                                    <a class="btn btn-success text-white btn-sm"
                                        href="{{ url('admin/invoices/detail/' . $data->id) }}">
                                        View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{ $invoices->links() }}
        </div>
    </div>
@endsection

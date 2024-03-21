@extends('layouts.admin')

@section('content')



    <div class="row">

        <div class="col-md-8">


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
                            @foreach ($orders as $data)
                                <tr>
                                    @php
                                        $invoice = str_pad($data->id, 6, '0', STR_PAD_LEFT);
                                    @endphp
                                    <td>{{ $invoice }}</td>

                                    <td>{{ $data->full_name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($data->schedule_date)) }}</td>
                                    <td>
                                        @if ($data->payment_status == 1)
                                            <i class="fa-solid fa-circle text-success" style="font-size: 7px;"></i>
                                            <span class="text-success">Paid</span>
                                        @else
                                            <i class="fa-solid fa-circle text-danger my-auto" style="font-size: 7px;"></i>
                                            <span class="text-danger">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($data->grand_total) }}</td>
                                    <td>
                                        <a class="btn btn-success text-white btn-sm"
                                            href="{{ url('admin/invoices/add-to-cart/' . $data->id) }}">
                                            <i class="fa-solid fa-circle-plus text-success"></i> Tambahkan</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-12 mt-5">
                {{ $orders->links() }}
            </div>

        </div>


        <div class="col-md-4">
            <div class="mb-3">
                <div class="table-responsive">
                    <div class="card border">
                        <div class="card-header bg-white">
                            Cart
                        </div>
                        <table id="invoicecart" class="table table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:20%">Servis</th>
                                    <th style="width:50%" class="text-center">Subtotal</th>
                                    <th style="width:20%" class="text-center">QTY</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp
                                @if (session('invoicecart'))
                                    @foreach (session('invoicecart') as $id => $details)
                                        @php $total += $details['grand_total'] * $details['quantity'] @endphp
                                        <tr data-id="{{ $id }}">
                                            <td data-th="Product">
                                                <div class="row">


                                                    <div class="col-md-8">
                                                        <div class="nomargin">{{ $details['order_id'] }}</div>

                                                    </div>
                                                </div>
                                            </td>
                                            <td data-th="Subtotal" class="text-center"> {{ $details['grand_total'] }}

                                            </td>
                                            <td data-th="Quantity" class="text-center"> <input type="number"
                                                    value="{{ $details['quantity'] }}"
                                                    class="form-control update-cart quantity" />


                                            </td>
                                            <td class="actions" data-th="">
                                                <button class="btn btn-link text-danger remove-from-cart"><i
                                                        class='fa fa-trash'></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2 mt-3">
                    <a href="{{ url('admin/orders/service') }}" class="btn btn-warning text-start"><i class='bx bx-car'></i>
                        Tambah Layanan Servis</a>
                </div> --}}
            </div>


            <div class="border rounded p-3 mb-3 bg-white">
                <h6>Total Harga</h6>
                <hr class="mx-n3">
                <div class="form-check custom-option custom-option-basic  rounded">
                    <label class="form-check-label custom-option-content" for="payment1">
                        <input name="payment" class="form-check-input" type="radio" value="" id="payment1"
                            checked="">
                        <span class="custom-option-header">
                            <div class="fw-semibold">Estimasi Harga</div>
                        </span>
                        <span class="custom-option-body">
                            <h3>Rp. {{ number_format($total) }}</h3>
                            <small>Ini Adalah Estimasi Harga Sesuai Produk dan Jasa yang anda Pilih</small>
                        </span>
                    </label>
                </div>


                <div class="d-grid gap-2 mx-auto mt-3">
                    <a class="btn btn-primary" href="{{ url('admin/invoices/invoicecheckout') }}">Checkout</a>
                </div>

            </div>
        </div>


    </div>





@endsection


@section('scripts')
    <script type="text/javascript">
        $(".update-cart").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update.invoicecart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    price: ele.parents("tr").find(".price").val(),
                    quantity: ele.parents("tr").find(".quantity").val(),
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.invoicecart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection

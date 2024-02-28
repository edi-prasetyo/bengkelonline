@extends('layouts.admin')

@section('content')


    <div class="p-3 mb-3">
        <div class="table-responsive">
            <div class="card">
                <div class="card-header bg-white">
                    Cart Not FUnction
                </div>
                <table id="admincart" class="table table-condensed">
                    <thead>
                        <tr>
                            <th style="width:50%">Product</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                            <th style="width:10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @if (session('admincart'))
                            @foreach (session('admincart') as $id => $details)
                                @php $total += $details['price']+$details['service_price'] * 1 @endphp
                                <tr data-id="{{ $id }}">
                                    <td data-th="Product">
                                        <div class="row">


                                            <div class="col-md-8">
                                                <h4 class="nomargin">{{ $details['name'] }}</h4>

                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Subtotal" class="text-center">IDR
                                        <input type="text" value="{{ number_format($details['price']) }}">

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
        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2 mt-3">
            <a href="{{ url('admin/orders/service') }}" class="btn btn-warning text-start"><i class='bx bx-car'></i>
                Tambah Layanan Servis</a>
        </div>
    </div>




    <div class="border rounded p-3 mb-3 bg-white">
        <h6>Total Harga</h6>
        <hr class="mx-n3">
        <div class="form-check custom-option custom-option-basic  rounded">
            <label class="form-check-label custom-option-content" for="payment1">
                <input name="payment" class="form-check-input" type="radio" value="" id="payment1" checked="">
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
            <a class="btn btn-primary" href="{{ url('admin/orders/admincheckout') }}">Checkout</a>
        </div>

    </div>

@endsection


@section('scripts')
    <script type="text/javascript">
        $(".update-cart").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update.admincart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
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
                    url: '{{ route('remove.from.admincart') }}',
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








{{-- @section('scripts')
<script type="text/javascript">
    $(".update-cart").click(function (e) {
           e.preventDefault();
           var ele = $(this);
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
</script>
@endsection --}}

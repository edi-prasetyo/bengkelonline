@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="col-md-8 mx-auto">
            <!-- Offer alert -->

            <ul class="list-group mb-3">
                @php $total = 0 @endphp
                @if (session('invoicecart'))
                    @foreach (session('invoicecart') as $id => $details)
                        @php $total += $details['grand_total'] * $details['quantity'] @endphp
                        <li class="list-group-item">
                            <div class="d-flex gap-3">
                                <div class="flex-shrink-0">
                                    {{-- <img src="{{$details['photo']}}" alt="google home" class="img-fluid" width="100px">
                        --}}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6 class="me-3">{{ $details['fullname'] }} <br>
                                                {{ $details['quantity'] }} x

                                            </h6>
                                            <div class="text-muted mb-1 d-flex flex-wrap">

                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-md-end">
                                                {{-- <button type="button" class="btn-close btn-pinned" aria-label="Close"></button>
                                    --}}
                                                <div class=""><span class="text-muted">
                                                        @php $subtotal = $details['grand_total'] * $details['quantity']  @endphp
                                                        Rp. {{ number_format($subtotal) }}<br>



                                                    </span>
                                                    {{-- <s class="text-muted">$359</s> --}}
                                                </div>
                                                {{-- <button type="button" class="btn btn-sm btn-label-secondary">Move
                                        to
                                        wishlist</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>
            <form action="{{ url('admin/invoices/invoice_orders') }}" method="POST">
                @csrf
                <div class="border rounded p-3 mb-3 bg-white">
                    <!-- Offer -->
                    <h6>Detail Estimasi</h6>
                    <hr class="mx-n3">

                    <!-- Price Details -->
                    <dl class="row mb-0">
                        <dt class="col-6 fw-normal">Estimasi Harga</dt>
                        <dd class="col-6 text-end">Rp. {{ number_format($total) }}</dd>

                        <dt class="col-6 fw-normal">Order Total</dt>
                        <dd class="col-6 text-end">Rp. {{ number_format($total) }}</dd>

                        <hr>

                        <dt class="col-6">Total</dt>
                        <dd class="col-6 fw-semibold text-end mb-0">Rp. {{ number_format($total) }}</dd>
                    </dl>
                </div>

                @csrf
                {{-- <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="customer_email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="customer_whatsapp" value="{{ Auth::user()->whatsapp }}"> --}}
                {{-- <input type="hidden" name="discount" value="0"> --}}

                <div class="row">
                    <div class="form-group mb-3 col-md-6">
                        <label class="form-label"> Pilih Customer</label>
                        <select name="user_id" class="form-select single-select-field" id="car-dropdown"
                            data-placeholder="Pilih Customer">
                            <option></option>
                            @foreach ($customers as $key => $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3 col-md-6">
                        <label class="form-label">Tanggal Invoice</label>
                        <input type="date" class="form-control" name="invoice_date">
                    </div>

                    <div class="form-group mb-3 col-md-6">
                        <label class="form-label">Down Payment</label>
                        <input class="form-control" name="down_payment">
                    </div>

                </div>

                <input type="hidden" name="grand_total" value="{{ $total }}">
                <input type="hidden" name="payment_method" value="transfer">
                <input type="hidden" name="payment_status" value="0">
                <input type="hidden" name="status" value="0">


                <div class="d-grid gap-2 mx-auto">
                    <button type="submit" class="btn btn-primary">Proses Invoice</button>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            $('#car-dropdown').on('change', function() {
                var idUser = this.value;
                $("#model-dropdown").html('');
                $.ajax({
                    url: "{{ url('admin/orders/services/fetch-car') }}",
                    type: "POST",
                    data: {
                        user_id: idUser,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#model-dropdown').html(
                            '<option value="">-- Pilih Mobil --</option>');
                        $.each(result.usercars, function(key, value) {
                            $("#model-dropdown").append('<option value="' + value.id +
                                '">' + value.model + ' ' + value.varian + ' - ' +
                                value.platnumber + ' (' + value.year + ')</option>');
                        });
                    }
                });
            });




        });
    </script>


    <script>
        $('.single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });


        $(document).ready(function() {
            $('.form-switch').on('change', function() {
                $('.form').removeClass('active');
                var formToShow = '.form-' + $(this).data('id');
                $(formToShow).addClass('active');
            });
        });

        $(function() {
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                //startDate: '+1d'
            });
        });
    </script>
@endsection

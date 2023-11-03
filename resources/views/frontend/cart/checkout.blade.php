@extends('layouts.app')
@section('title', 'Cart')
@include('layouts.inc.frontend.header')
@section('content')

<div class="container">


    <div class="col-md-8 mx-auto">
        <!-- Offer alert -->

        <ul class="list-group mb-3">
            @php $total = 0 @endphp
            @if(session('cart'))
            @foreach(session('cart') as $id => $details)
            @php $total += $details['price']+$details['service_price'] @endphp
            <li class="list-group-item">
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                        {{-- <img src="{{$details['photo']}}" alt="google home" class="img-fluid" width="100px">
                        --}}
                    </div>
                    <div class="flex-grow-1">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="me-3">{{
                                    $details['name']
                                    }}<br>
                                    <div class="badge bg-label-primary"> Jasa Mekanik</div>

                                </h6>
                                <div class="text-muted mb-1 d-flex flex-wrap">

                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="text-md-end">
                                    {{-- <button type="button" class="btn-close btn-pinned" aria-label="Close"></button>
                                    --}}
                                    <div class=""><span class="text-muted">
                                            Rp. {{ number_format($details['price']) }}<br>
                                            <small>Rp. {{ $details['service_price'] }}</small>


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
        <form action="{{url('orders')}}" method="POST">
            <div class="card mb-5">
                <div class="card-header">
                    Informasi
                </div>
                <div class="card-body">

                    <div class="card-radio">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="radio" class="form-switch" name="home_service" id="one" data-id="a"
                                    value="0" checked>

                                <label for="one" class="box first">

                                    <span class="circle"></span>
                                    <span>
                                        <span class="h4"> Service Dibengkel</span><br>
                                        <small>anda datang ke bengkel</small>
                                    </span>


                                </label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" class="form-switch" name="home_service" data-id="b" id="two"
                                    value="0">


                                <label for="two" class="box second">
                                    <div class="plan">
                                        <span class="circle"></span>
                                        Service Dirumah<br>
                                        Montir kami akan datang kelokasi mobil
                                    </div>

                                </label>
                            </div>
                        </div>

                    </div>



                    <div class="form form-b">
                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="form-label">Pilih Kota</label>
                                <select class="form-select basic-usage" id="country-dropdown"
                                    data-placeholder="Choose one thing" name="province">
                                    <option></option>
                                    @foreach($provinces as $key => $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kota</label>
                                <select id="state-dropdown" class="form-select" name="city">
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="address" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="full_name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor whatsapp</label>
                            <input type="text" name="phone_number" class="form-control">
                        </div>
                    </div>


                </div>
            </div>


            <div class="border rounded p-3 mb-3 bg-white">
                <!-- Offer -->
                <h6>Detail Pembaayaran</h6>
                <hr class="mx-n3">

                <!-- Price Details -->
                <dl class="row mb-0">
                    <dt class="col-6 fw-normal">Total Belanja</dt>
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
            <input type="hidden" name="grand_total" value="{{$total}}">
            <input type="hidden" name="payment_method" value="transfer">
            <input type="hidden" name="payment_status" value="0">
            <input type="hidden" name="status" value="0">

            <div class="d-grid gap-2 mx-auto">
                <button type="submit" class="btn btn-primary">Proses Order</button>
            </div>

        </form>
    </div>
</div>


@endsection

@section('scripts')
<script>
    $(document).ready(function () {

/*------------------------------------------
--------------------------------------------
Country Dropdown Change Event
--------------------------------------------
--------------------------------------------*/
$('#country-dropdown').on('change', function () {
    var idProvince = this.value;
    $("#state-dropdown").html('');
    $.ajax({
        url: "{{url('services/fetch-city')}}",
        type: "POST",
        data: {
            province_id: idProvince,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
            $('#state-dropdown').html('<option value="">-- Select Type --</option>');
            $.each(result.cities, function (key, value) {
                $("#state-dropdown").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
            $('#city-dropdown').html('<option value="">-- Pilih Kota --</option>');
        }
    });
});

});

    $( '.basic-usage' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
</script>

<script>
    $(document).ready(function() {
  $('.form-switch').on('change', function() {
    $('.form').removeClass('active');
    var formToShow = '.form-' + $(this).data('id');
    $(formToShow).addClass('active');
  });
});
</script>

@endsection
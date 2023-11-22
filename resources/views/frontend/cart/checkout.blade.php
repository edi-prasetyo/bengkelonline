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
                                <label class="form-label">Pilih Provinsi</label>
                                <select class="form-select" id="country-dropdown" data-placeholder="Choose one thing"
                                    name="province">
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
                            <input type="text" name="full_name"
                                class="form-control @error('full_name') is-invalid @enderror">
                            @error('full_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor whatsapp</label>
                            <input type="text" name="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror">
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="text" name="schedule_date"
                                class="form-control @error('schedule_date') is-invalid @enderror" id="datepicker">
                            @error('schedule_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jam</label>
                            <select name="schedule_time"
                                class="form-select @error('schedule_time') is-invalid @enderror"
                                aria-label="Default select example">
                                <option></option>
                                <option value="09:00">09:00</option>
                                <option value="09.30">09.30</option>
                                <option value="10.00">10.00</option>
                                <option value="10.30">10.30</option>
                                <option value="11.00">11.00</option>
                                <option value="11.30">11.30</option>
                                <option value="12.00">12.00</option>
                                <option value="12.30">12.30</option>
                                <option value="13.00">13.00</option>
                                <option value="13.30">13.30</option>
                                <option value="14.00">14.00</option>
                                <option value="14.30">14.30</option>
                                <option value="15.00">15.00</option>
                                <option value="15.30">15.30</option>
                                <option value="16.00">16.00</option>
                                <option value="16.30">16.30</option>
                                <option value="17.00">17.00</option>
                            </select>
                            @error('schedule_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    Detail kendaraan
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 ">
                            <label class="form-label">Pilih Merek</label>
                            <select class="form-select single-select-field @error('car_brand') is-invalid @enderror"
                                id="car-dropdown" data-placeholder="Choose one thing" name="car_brand">
                                <option></option>
                                @foreach($brands as $key => $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                            @error('car_brand')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Model Kendaraan</label>
                            <select id="model-dropdown" class="form-select @error('car_model') is-invalid @enderror"
                                name="car_model">
                            </select>
                            @error('car_model')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Tahun Kendaraan</label>
                            <input type="text" name="car_year"
                                class="form-control @error('car_year') is-invalid @enderror">
                            @error('car_year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>


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
            $('#state-dropdown').html('<option value="">-- Pilih Kota --</option>');
            $.each(result.cities, function (key, value) {
                $("#state-dropdown").append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });
});

$('#car-dropdown').on('change', function () {
    var idBrand = this.value;
    $("#model-dropdown").html('');
    $.ajax({
        url: "{{url('services/fetch-model')}}",
        type: "POST",
        data: {
            brand_id: idBrand,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
            $('#model-dropdown').html('<option value="">-- Select Model --</option>');
            $.each(result.carmodel, function (key, value) {
                $("#model-dropdown").append('<option value="' + value
                    .name + '">' + value.name + '</option>');
            });
        }
    });
});


});

</script>

<script>
    $( '.single-select-field' ).select2( {
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


$(function(){
    
  $('#datepicker').datepicker({
    format: 'yyyy-dd-mm',
    startDate: '+1d'
  });
});

</script>

@endsection
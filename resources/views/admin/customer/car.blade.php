@extends('layouts.admin')

@section('content')
<div class="col-md-12">
    @if(session('message'))
    <div class="col-md-12">
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    </div>
    @endif

    <div class="card mb-3">
        <div class="card-header bg-white">
            Tambah Mobil {{$user->name}}
        </div>
        <div class="card-body">
            <form action="{{url('admin/customers/add-car/'.$user->id)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 ">
                        <label class="form-label">Pilih Merek</label>
                        <select class="form-select single-select-field @error('brand_id') is-invalid @enderror"
                            id="car-dropdown" data-placeholder="Pilih Mererk" name="brand_id" required>
                            <option></option>
                            @foreach($brands as $key => $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Model Kendaraan</label>
                        <select id="model-dropdown"
                            class="form-select single-select-field @error('car_model') is-invalid @enderror"
                            data-placeholder="Pilih Model" name="car_model" required>
                        </select>
                        @error('car_model')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Varian</label>
                        <input type="text" name="varian" class="form-control @error('varian') is-invalid @enderror"
                            required>
                        @error('varian')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tahun Kendaraan</label>
                        <input type="text" name="car_year" class="form-control @error('car_year') is-invalid @enderror"
                            required>
                        @error('car_year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Plat Nomor</label>
                        <input type="text" name="platnumber"
                            class="form-control @error('platnumber') is-invalid @enderror" required>
                        @error('platnumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="row my-3">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Simpan') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Data Mobil Customer</h4>

        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Model</th>
                        <th scope="col">Plat Nomor</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @foreach ($cars as $car)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$car->brand}}</td>
                        <td>
                            {{$car->model}} -
                            {{$car->varian}} -
                            {{$car->year}}
                        </td>
                        <td>{{$car->platnumber}}</td>
                        <td>
                            <a href="{{url('admin/customers/cars/edit/' .$car->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>
                            <a href="{{url('admin/customers/cars/delete-car/' .$car->id)}}"
                                class="btn btn-sm btn-danger text-white">Hapus</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-12 mt-5">
        {{$cars->links()}}
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


@endsection
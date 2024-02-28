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

        <div class="card mb-3">
            <div class="card-header bg-white">
                Create New Customer
            </div>
            <div class="card-body">
                <form action="{{ url('admin/customers') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="whatsapp" class="col-form-label">{{ __('Whatsapp') }}</label>
                                <input id="whatsapp" type="text"
                                    class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp"
                                    value="{{ old('whatsapp') }}" autocomplete="whatsapp">

                                @error('whatsapp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>

                                <input id="password" type="text"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <label class="form-label">Pilih Provinsi</label>
                            <select class="form-select single-select-field" id="country-dropdown"
                                data-placeholder="Choose one thing" name="province_id">
                                <option></option>
                                @foreach ($provinces as $key => $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kota</label>
                            <select id="state-dropdown" class="form-select single-select-field" name="city_id">
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label> Alamat</label>
                                <textarea name="address" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
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
                <h4 class="my-auto">Customer</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jumlah Mobil</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    @php $count = $usersCars->where('user_id', $customer->id)->count() @endphp
                                    {{ $count }}
                                </td>
                                <td>
                                    <a href="{{ url('admin/customers/edit/' . $customer->id) }}"
                                        class="btn btn-sm btn-primary text-white">Edit</a>
                                    <a href="{{ url('admin/customers/cars/' . $customer->id) }}"
                                        class="btn btn-sm btn-primary text-white">

                                        Data Mobil</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-12 mt-5">
            {{ $customers->links() }}
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
            $('#country-dropdown').on('change', function() {
                var idProvince = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('services/fetch-city') }}",
                    type: "POST",
                    data: {
                        province_id: idProvince,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dropdown').html('<option value="">-- Pilih Kota --</option>');
                        $.each(result.cities, function(key, value) {
                            $("#state-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                    }
                });
            });




        });
    </script>
@endsection

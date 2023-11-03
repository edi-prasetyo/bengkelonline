@extends('layouts.app')
@section('title', 'Booking Bengkel Online')
@section('content')
@include('layouts.inc.frontend.header')
<div class="container">
    <div class="col-sm-8 col-lg-5 mx-auto my-5">
        <div class="card shadow">
            <div class="card-header bg-white border-0 py-3">
                <h4> Layanan Darurat </h4>
            </div>
            <div class="card-body px-4">
                <div class="row">
                    <form id="salsa" method="POST" accept-charset="utf-8">

                        <div class="form-group mb-2">
                            <div class="input nama"><label for="nama">Nama</label><input placeholder="nama" name="nama"
                                    type="text" class="form-control" id="nama" required /></div>
                        </div>
                        <div class="form-group mb-2">
                            <div class="input nama"><label for="nama">No Whatsapp</label><input placeholder="nama"
                                    name="email" type="email" class="form-control" id="email" required /></div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nama">Area</label>
                            <select class="form-select" id="area" name="area" data-placeholder="Pilih Area">
                                <option></option>
                                <option>DKI Jakarta</option>
                                <option>Bogor</option>
                                <option>Depok</option>
                                <option>Tangerang</option>
                                <option>Bekasi</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <div class="input pesan"><label for="pesan">Message</label><textarea class="form-control"
                                    rows="4" id="pesan" name="pesan" placeholder="pesan"></textarea></div>
                        </div>
                        <div class="form-group mb-2">
                            <div class="submit"><button type="submit" id="btn-wa"
                                    class="btn btn-primary btn-user btn-block">Send</button>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
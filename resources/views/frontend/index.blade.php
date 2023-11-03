@extends('layouts.app')
@section('title', 'Bengkel Online')
@section('content')

<section class="bg-warning py-5 my-3">
    <div class="container">

        <div class="col-md-10 mx-auto">
            <div class="row align-items-center g-5 py-5">
                <div class="col-lg-7 py-3">
                    <h1 class="display-6 fw-bold mb-3">Bengkel Mobil Panggilan Online 24 Jam</h1>
                    <p class="lead">Jasa Layanan Servis Mobil panggilan, Kami siap melakukan perbaikan mobil di tempat
                        anda</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="https://wa.me/{{$option_nav->whatsapp}}"
                            class="btn btn-primary btn-lg px-4 me-md-2">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-sm-8 col-lg-5">
                    <div class="card shadow form-darurat">
                        <div class="card-header bg-white border-0 py-3">
                            <h4> Layanan Darurat </h4>
                        </div>
                        <div class="card-body px-4">
                            <div class="row">
                                <form id="salsa" method="POST" accept-charset="utf-8">

                                    <div class="form-group mb-2">
                                        <div class="input nama"><label for="nama">Nama</label><input placeholder="nama"
                                                name="nama" type="text" class="form-control" id="nama" required /></div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <div class="input nama"><label for="nama">No Whatsapp</label><input
                                                placeholder="nama" name="email" type="email" class="form-control"
                                                id="email" required /></div>
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
                                        <div class="input pesan"><label for="pesan">Message</label><textarea
                                                class="form-control" rows="4" id="pesan" name="pesan"
                                                placeholder="pesan"></textarea></div>
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
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container my-3">
        <h3 class="text-center py-5">Mengapa Memilih kami?</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="feature col text-center">
                            <div
                                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-3 rounded">
                                <i class='bx bxs-user-pin'></i>
                            </div>
                            <h5 class="fw-bold">Mekanik Berpengalaman</h5>
                            <p>Mekanik kami berpengalaman dalam memperbaiki mobil dari berbagai merek</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="feature col text-center">
                            <div
                                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-3 rounded">
                                <i class='bx bxs-car-mechanic'></i>
                            </div>
                            <h5 class="fw-bold">Kami Datang</h5>
                            <p>Kami akan datang ke lokasi anda untuk perbaikan mobil kesayangan anda.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <div class="feature col text-center">
                            <div
                                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3 p-3 rounded">
                                <i class='bx bxs-wallet'></i>
                            </div>
                            <h5 class="fw-bold">Biaya Terjangkau</h5>
                            <p>Biaya service terjangkau dengan kualitas layanan terbaik dari kami.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section>
    <div class="container my-3">
        <h3 class="text-center py-5">Pilih Jenis Perbaikan Mobil Anda</h3>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-sm-2 col-6">
                <a href="{{url('category/' .$category->slug)}}" class="bg-dark text-white border-0">
                    <div class="card p-3 mb-3 border-0 shadow">
                        <div class="p-2">
                            <div class="text-center"> <img src="{{$category->image}}" width="50%" class="img-fluid" />
                            </div>
                            <h6 class="text-center text-muted"> {{$category->name}} </h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section> --}}



{{-- <div class="container">
    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-4 col-6 pb-md-4 mb-3">
            <a href="{{url('category/' .$category->slug)}}" class="card bg-dark text-white shadow-sm border-0">
                <img class="card-img" style="opacity: .25" src="{{$category->image}}" alt="Card image">
                <div class="card-img-overlay d-flex flex-column align-items-start">
                    <h4 class="card-title">{{$category->name}}</h4>
                    <p class="card-text mt-auto">{{$category->description}}</p>
                    <span class="badge bg-danger font-weight-normal mr-2">Executive Views</span>
                </div>
            </a>
        </div>
        @endforeach

    </div>
</div> --}}

<section>
    <div class="container">
        <div class="card bg-warning mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="img-hero">
                        <img class="img-fluid" src="{{asset('uploads/logo/maskot.png')}}">
                    </div>
                </div>
                <div class="col-md-8 text-dark">
                    <h1 class="ps-5 pe-5 pt-5 fw-bold">Layanan Service Mobil Panggilan 24 Jam
                    </h1>
                    <p class="ps-5 pe-5 mb-5 mt-3">Cek kondisi mobil kesayangan Anda agar terhindar dari kerusakan parah
                        dan membuat biaya perbaikannya makin mahal Periksa kondisi komponen mobil Anda hingga di 32
                        titik dengan General Checkup, Kami siap datang ke tempat anda untuk melakukan perbaikan mobil
                        kesayangan anda, Tanpa harus antri!
                    </p>
                    <a href="https://wa.me/{{$option_nav->whatsapp}}"
                        class="btn btn-success btn-lg ms-5 mb-3 ps-5 pe-5 pt-3 pb-3"><i class='bx bxl-whatsapp'></i>
                        Chat Sekarang </a>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    $("#btn-wa").click(function(){
        
    // var nomor = 628111550570;
    var nama = document.getElementById('nama').value;
    var email = document.getElementById('email').value;
    var pesan = document.getElementById('pesan').value;
    var area = document.getElementById('area').value;

    var whatsappMessage="*Nama* :" +nama+"\r\n"+"*Email* :"+email+"\r\n"+"*area* :"+area+"\r\n"+"*Pesan* :"+pesan;

    whatsappMessage = window.encodeURIComponent(whatsappMessage);

    var win = window.open("https://wa.me/628119456678?text="+whatsappMessage);
    if (win) {
        //Browser has allowed it to be opened
        win.focus();
    } else {
        //Browser has blocked it
        alert('Please allow popups for this website');
    }
return false;
});
</script>

@endsection












{{-- <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active':''}} ">
            @if($slider->image)
            <img src="{{asset($slider->image)}}" class="d-block w-100" alt="{{$slider->title}}">
            @endif
            <div class="carousel-caption d-none d-md-block my-auto">
                <div class="custom-carousel-content ">
                    <h1>{{$slider->title}}</h1>
                    <p>{{$slider->description}}</p>
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div> --}}

@endsection

@section('scripts')
<script>
    function gotowhatsapp() {

var name = document.getElementById("name").value;
var phone = document.getElementById("phone").value;
var email = document.getElementById("email").value;
var service = document.getElementById("service").value;

var url = "https://wa.me/628119456678?text="
    + "Name: " + name + "%0a"
    + "Phone: " + phone + "%0a"
    + "Email: " + email + "%0a"
    + "Service: " + service;

window.open(url, '_blank').focus();
}
</script>
@endsection
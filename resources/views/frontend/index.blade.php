@extends('layouts.app')
@section('title', 'Bengkel Online')
@section('content')

<section class="mt-5">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner" style="min-height: 450px; background:#011c47;">

            <?php $i = 1;
            foreach ($sliders as $popular_tour) : ?>
            <div class="carousel-item <?php if ($i == 1) {
                                                echo 'active';
                                            } ?>">
                <div class="container">
                    <div class="row gx-5 align-items-center justify-content-center col-10 mx-auto">
                        <div class="col-md-9 col-xl-7 col-xxl-6">
                            <div class="my-5 text-center text-xl-start">
                                <h1 class="display-5 fw-bolder text-white mb-2">

                                    <?php echo $popular_tour->title; ?>

                                </h1>
                                <p class="lead fw-normal text-white mb-4">

                                    <?php echo substr($popular_tour->description, 0, 95); ?>

                                </p>

                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                    <a class="btn btn-primary btn-lg px-4 me-sm-3 text-white mt-2" href="#">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                            <div class="img-slide">
                                <img class="img-fluid rounded-3 my-5" src="<?php echo url($popular_tour->image) ?>"
                                    alt="<?php echo $popular_tour->title; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++;
            endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section class="">
    <div class="container py-3">
        <div class="col-md-10 mx-auto">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <h1 class="display-6 fw-bold mb-3">Bengkel Mobil Panggilan Online 24 Jam dan Layanan Darurat</h1>
                    <p class="lead">Jasa Layanan Servis Mobil panggilan, Kami siap melakukan perbaikan mobil di tempat
                        anda. Layanan Darurat saat mogok di jalan silahkan Isi Form untuk pemesanan</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="https://wa.me/{{$option_nav->whatsapp}}"
                            class="btn btn-primary btn-lg px-4 me-md-2">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-sm-8 col-lg-5">
                    <div class="card shadow border-0">
                        <div class="card-header bg-white border-0">
                            <h4> Layanan Darurat </h4>
                        </div>
                        <div class="card-body px-4">
                            <div class="row">
                                <form id="salsa" method="POST" accept-charset="utf-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <div class="input nama"><label for="nama">Nama</label><input
                                                        placeholder="nama" name="nama" type="text" class="form-control"
                                                        id="nama" required /></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <div class="input nama"><label for="nama">No Whatsapp</label><input
                                                        placeholder="No Whatsapp" name="phone" type="number"
                                                        class="form-control" id="phone" required /></div>
                                            </div>
                                        </div>
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

<section class="bg-primary-subtle">
    <div class="container pb-5">
        <div class="col-md-8 mx-auto">
            <h3 class="text-center py-5">Pilih Layanan</h3>
            <div class="row">
                @foreach($services as $key => $service)
                <div class="col-md-3 col-6">
                    <a href="{{url('services/' . $service->slug)  }}" class="text-decoration-none text-muted example_f">
                        <div class="card mb-3 border-0 border-bottom border-5 border-primary shadow-sm">
                            <div class="card-body text-center">
                                <img src="{{asset($service->image)}}" class="img-fluid">
                                <h5 class="mb-2">{{$service->name}}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</section>

<section class="py-3 my-3 bg-white">
    <div class="container my-3">
        <h3 class="text-center py-5">Mengapa Memilih kami?</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
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
                <div class="card mb-3">
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
                <div class="card mb-3">
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

<section class="my-5">
    <div class="container">
        <h3 class="text-center py-5">Update Berita Terbaru</h3>
        <div id="posts" class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow loading">
                    <div class="image-loading">

                    </div>
                    <div class="content-loading">
                        <h4></h4>
                        <div class="description-loading">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow loading">
                    <div class="image-loading">

                    </div>
                    <div class="content-loading">
                        <h4></h4>
                        <div class="description-loading">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow loading">
                    <div class="image-loading">

                    </div>
                    <div class="content-loading">
                        <h4></h4>
                        <div class="description-loading">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow loading">
                    <div class="image-loading">

                    </div>
                    <div class="content-loading">
                        <h4></h4>
                        <div class="description-loading">

                        </div>
                    </div>
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

<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: 'https://bengkelonline.com/blog/wp-json/wp/v2/posts?per_page=4&orderby=id',

            success: function (data) {
                var posts_html = '';
                $.each(data, function (index, post) {
                    posts_html += '<div class="col-md-3"><div class="card mb-3"><img class="img-fluid" src="' + post.yoast_head_json.og_image[0].url + '">';
                    posts_html += '<div class="card-body"><a class="text-decoration-none text-muted" href="' + post.link + '"><h4>' + post.title.rendered + '</h4></a></div>';
                    posts_html += '<div class="card-footer bg-white text-muted"><p> <i class="bx bx-user me-3"></i>' + post.yoast_head_json.author + '</p></div></div></div>';
                    
                });
                $('#posts').html(posts_html);
            },
            error: function (request, status, error) {
                alert(error);
            }
        });
    });
</script>

@endsection





@endsection

{{-- @section('scripts')
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
@endsection --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    Data User
                </div>
                <div class="card-body">
                    Total topup
                    <h3 class="fw-bold">{{$topup->amount}}</h3>
                    @if($topup->struk == null)
                    <div class="alert alert-success">User Belum mengupload bukti transfer</div>
                    @else
                    <form action="{{url('admin/topups/update/'. $topup->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="user_id" value="{{$topup->user_id}}">
                        <button type="submit" class="btn btn-primary">Verifikasi</button>
                    </form>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-white">
                    Bukti Transfer
                </div>
                <div class="card-body">
                    @if($topup->struk == null)
                    <div class="alert alert-success">Belum ada bukti Transfer</div>
                    @else
                    <img class="img-fluid" src="{{asset('uploads/struk/' .$topup->struk)}}">
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
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



    <ul class="cbp_tmtimeline">
        @php
        $i = +1;
        @endphp
        @foreach($history as $key => $data)
        <li>
            <time class="cbp_tmtime" datetime="2017-11-04T03:45"><span>{{date('d M Y',
                    strtotime($data->schedule_date))}}</span>
                <span>{{date('l',
                    strtotime($data->schedule_date))}}</span></time>
            <div class="cbp_tmicon bg-info">{{$i++}}</div>
            <div class="cbp_tmlabel text-white">
                <h2>posted a status update</h2>
                <p class="d-flex justify-content-between align-items-start">
                <div>
                    @foreach($order_item as $key => $item)
                    @if($item->order_id == $data->id )

                    {{$item->name}}<br>

                    @endif
                    @endforeach
                </div>
                <div>
                    <i class="fa-solid fa-gauge-high"></i> {{$data->kilometer}} KM
                </div>

                </p>
            </div>
        </li>
        @endforeach

    </ul>




</div>

@endsection
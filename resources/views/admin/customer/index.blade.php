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
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Customer</h4>
            <a href="{{url('admin/customers/create')}}" class="btn btn-success text-white">Add Customer</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->email}}</td>
                        <td>
                            <a href="{{url('admin/category/edit/' .$customer->id)}}"
                                class="btn btn-sm btn-primary text-white">Edit</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="col-md-12 mt-5">
        {{$customers->links()}}
    </div>
</div>
@endsection
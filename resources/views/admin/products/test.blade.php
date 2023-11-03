@extends('layouts.admin')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-start">
            <h4 class="my-auto">Add Product</h4>
            <a href="{{ url('admin/products') }}" class="btn btn-success text-white"><i
                    class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif
            <form action="{{ url('admin/products/test') }}" method="POST">
                @csrf

                <h3 class="my-3 pt-3 border-top">Tags</h3>
                <select class="form-select" name="tag_id[]" id="multiple-select-field" data-placeholder="Pilih Tag"
                    multiple>
                    @foreach($tags as $key => $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
                <div class="mt-5">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

        </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('scripts')

<script>
    // Select 2
    $( '#multiple-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    closeOnSelect: false,
} );
</script>

@endsection
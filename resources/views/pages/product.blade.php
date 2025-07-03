@extends('mainlayout')

@section('maincontent')
@if(session('message'))
    <script>
        alert("{{ session('message') }}");
    </script>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="color:red; margin-top: 20px;">
        <center><b>{{ session('error') }}</b></center>
    </div>
@endif
<link rel="stylesheet" href="/css/style.css">
<div class="product-content">
        <div class="productbox">
        @foreach ($product as $data)
            <div class="cards">
                <div class="image-product" style="background-image: url('{{$data->gambar_product}}')"></div>
                    <div class="contentt">
                        <h2>{{$data->nama_product}}</h2>
                        <h3 class="price">Rp.{{$data->harga_product}}</h3>
                        <p>{{$data->desc_product}}</p>
                        <form action="{{url('addcart', $data->id_product)}}" method="POST">
                            @csrf
                            <input type="number" value="1" min="1" class="form-control" name="quantity">
                            <br>
                            <br>
                            <input class="btn btn-primary" type="submit" value="Add to cart">
                        </form>
                    </div>
                </div>
        @endforeach
        </div>
</div>
@endsection

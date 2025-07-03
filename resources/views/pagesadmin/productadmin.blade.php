@extends('layoutsadmin')

@section('maincontentadmin')
<link rel="stylesheet" href="/css/styleadmin.css">
</head>
<body>
<main role="main">
        <section class="panel important">
            <center><h1>Product</h1></center>
            <div class="add">
                <form action="{{url('productadmin/add')}}" method="get">
                    @csrf
                    <button type="submit" class="add-btn">Add Product</button>
                </form>
            </div>
            <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Detail</th>
                </tr>
            </thead>
            @foreach ($product as $item)
            <tbody>
                <tr>
                    <td>{{ $item->nama_product }}</td>
                    <td>{{ $item->harga_product }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->desc_product }}</td>
                    <td><img src="{{ $item->gambar_product }}" style="width:100px; height:auto"></td>
                    <td>
                        <form action="{{url('productadmin/edit')}}/{{$item->id_product}}" method="GET">
                            @csrf
                                <button type="submit" class="edit">Edit</button>
                        </form>
                        <form onsubmit="return confirm('Are you sure to delete this product?');" action="/productadmin/{{$item->id_product}}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </section>
    </main>
</body>
</head>
@if(session('successadd'))
    <script>
        alert("{{session('successadd')}}");
    </script>
@endif
@endsection
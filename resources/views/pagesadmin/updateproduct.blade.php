<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kudapannya</title>
    <link rel="stylesheet" href="/css/styleupdate.css">
</head>
<body>
<section class="panel important">
    <div class="header">
        <h1>Update Product</h1>
        <div class="back">
            <form action="/productadmin" method="get">
                @csrf
                <button type="submit">Back</button>
            </form>
        </div>
    </div>
<form action="{{ route('productadmin.update', $product->id_product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="nama_product">Nama Produk:</label>
    <input type="text" name="nama_product" value="{{ $product->nama_product }}" required>
    <label for="harga_product">Harga:</label>
    <input type="number" name="harga_product" value="{{ $product->harga_product }}" required>
    <label for="stok">Stok:</label>
    <input type="number" name="stok" value="{{ $product->stok }}" required>
    <label for="desc_product">Deskripsi:</label>
    <textarea name="desc_product" required>{{ $product->desc_product }}</textarea>
    <label for="gambar_product">Gambar Produk:</label>
    <input type="file" name="gambar_product" accept="image/*">
    <div class="update">
        <center><button type="submit">Update Product</button></center>
    </div>
</form>
</section>
</body>
</html>

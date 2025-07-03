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
        <h1>Add Product</h1>
        <div class="back">
            <form action="/productadmin" method="get">
                @csrf
                <button type="submit">Back</button>
            </form>
        </div>
    </div>
<form action="{{ route('add_process') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="nama_product">Product's Name:</label>
    <input type="text" name="nama_product" placeholder="Product's name" required>
    <label for="harga_product">Price:</label>
    <input type="number" name="harga_product" placeholder="Price" required>
    <label for="stok">Stock:</label>
    <input type="number" name="stok" placeholder="Stock" required>
    <label for="desc_product">Description:</label>
    <textarea name="desc_product" placeholder="Description" required></textarea>
    <label for="gambar_product">Product's Image:</label>
    <input type="file" name="gambar_product" accept="image/*">
    <div class="update">
        <center><button type="submit">Add Product</button></center>
    </div>
</form>
</section>
</body>
</html>

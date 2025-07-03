@if(session('removesuccess'))
    <script>
        alert("Product removed from the cart.");
    </script>
@endif
@if(session('error'))
    <script>
        alert("Product not found in the cart.");
    </script>
@endif
@if(session('failedcheckout'))
    <script>
        alert("{{session('failedcheckout')}}");
    </script>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@extends('mainlayout')
@section('maincontent')
<link rel="stylesheet" href="css/stylecart.css">
<section class="contentcart">
    <h1>Your Cart</h1>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                <tr>
                    <td>
                        <input type="checkbox" class="product-checkbox" name="selectedProducts[]" value="{{ $cartItem['cart']->id }}" onchange="updateTotal()">
                    </td>
                    <td>
                        <img src="{{ $cartItem['image_url'] }}" alt="{{ $cartItem['cart']->nama_product }}" class="cart-product-image">
                        {{ $cartItem['cart']->nama_product }}
                    </td>
                    <td>{{ $cartItem['cart']->harga }}</td>
                    <td>
                        <input type="number" value="{{ $cartItem['quantity'] }}" class="cart-quantity" disabled>
                    </td>
                    <td>{{ $cartItem['total'] }}</td>
                    <td>
                    <form onsubmit="return confirm('Are you sure to delete this product from your cart?');" action="{{ url('/removecart', $cartItem['cart']->nama_product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cart-remove-btn">Remove</button>
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="totalSection">
            <p>Total Quantity: <span id="totalQuantity">0</span></p>
            <p>Total Price: <span id="totalPrice">0.00</span></p>
        </div>
        <form action="{{ url('/checkout') }}" method="POST">
            @csrf
            <input type="hidden" name="selectedProducts" id="selectedProductsInput" value="">
            <div class="checkoutButtonContainer">
                <button class="checkoutButton" type="submit" onclick="checkout()">Checkout</button>
            </div>
        </form>
    
</section>
<script>
    function updateTotal() {
        var checkboxes = document.querySelectorAll('.product-checkbox');
        var totalQuantity = 0;
        var totalPrice = 0;

        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                var row = checkbox.closest('tr');
                var quantity = parseInt(row.querySelector('.cart-quantity').value);
                var price = parseFloat(row.querySelector('td:nth-child(3)').textContent);
                var total = quantity * price;

                totalQuantity += quantity;
                totalPrice += total;
            }
        });

        // Update total quantity and total price on the page
        document.getElementById('totalQuantity').innerText = totalQuantity;
        document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
    }

    function checkout() {
        var selectedProductsInput = document.getElementById('selectedProductsInput');
        var checkboxes = document.querySelectorAll('.product-checkbox:checked');
        var selectedProducts = [];

        checkboxes.forEach(function (checkbox) {
            selectedProducts.push(checkbox.value);
        });

        selectedProductsInput.value = JSON.stringify(selectedProducts);
    }
</script>
@endsection

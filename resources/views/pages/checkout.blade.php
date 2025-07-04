<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/stylecheckout.css">
<body>
<h2>Checkout Form</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="name">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city">
            <label for="zip">Zip</label>
            <input type="text" id="zip" name="zip">
          </div>
          @if (!empty($selectedProducts))
                @foreach ($selectedProducts as $cartItem)
                    <input type="hidden" name="orderedProducts[{{ $cartItem->id }}][nama_product]" value="{{ $cartItem->nama_product }}">
                    <input type="hidden" name="orderedProducts[{{ $cartItem->id }}][quantity]" value="{{ $cartItem->quantity }}">
                    <input type="hidden" name="orderedProducts[{{ $cartItem->id }}][price]" value="{{ $cartItem->harga }}">
                @endforeach
            @endif
          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv">
              </div>
            </div>
          </div>
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
      <form action="/cart">@csrf<input type="submit" value="Continue Shopping" class="btn-back"></form>
    </div>
</div>
<div class="col-25">
    <div class="container">
        @php
            $totalQuantity = 0;
            $totalPrice = 0;
        @endphp
        @if (!empty($selectedProducts))
            @foreach ($selectedProducts as $cartItem)
                @php
                    $totalQuantity += $cartItem->quantity;
                    $totalPrice += $cartItem->harga * $cartItem->quantity;
                @endphp
            @endforeach
        <h4>Order Summary <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>{{ $totalQuantity }}</b></span></h4>
            @foreach ($selectedProducts as $cartItem)
                <p>
                    <a href="#"></a>{{ $cartItem->nama_product }} x 
                    <span class="quantity">{{ $cartItem->quantity }}</span>
                    <span class="price">Rp.{{ $cartItem->harga * $cartItem->quantity }}</span>
                </p>
            @endforeach
            <p>Total <span class="price" style="color:black"><b>Rp.{{$totalPrice}}</b></span></p>
        @else
            <p>No selected products</p>
        @endif
    </div>
</div>
</div>
</body>
    <nav class="nav">
        <a href="/homepage"><img src="/images/kudapan.png" width="60" height="60" class="logo"></a>
        <div class="search-product">
            <form action="{{ url('search') }}" method="GET">
                <input type="text" name="search" placeholder="Search Product...">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="menu">
            <ul>
                <li><a href="homepage">Home</a></li>
                <li><a href="product">Product</a></li>
                <li><a href="about-us">About Us</a></li>
                <li><a href="cart"><img src="/images/cart.jpg" width="20" height="15"> Cart</a></li>
                @if(Auth::check())
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">Profile</button>
                            <div class="dropdown-content">
                                <a href="/logout">Logout</a>
                            </div>
                        </div>
                    </li>
                @else
                    <li><a href="/profile">Sign in</a></li>
                @endif
            </ul>
        </div>
    </nav>
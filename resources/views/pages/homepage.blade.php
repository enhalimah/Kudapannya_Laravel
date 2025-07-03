@extends('mainlayout')

@section('maincontent')
<link rel="stylesheet" href="/css/style.css">
    <section class="ads">
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">
                <div class="slide first">
                    <img src="/images/promo.jpeg" alt="">
                </div>
                <div class="slide">
                    <img src="/images/about.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="/images/coffeebun.png" alt="">
                </div>
                <div class="slide">
                    <img src="/images/cookies.png" alt="">
                </div>
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>
                <div class="navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                    <label for="radio4" class="manual-btn"></label>
                </div>
            </div>
        <script type="text/javascript">
            var counter = 1;
            setInterval(function(){
                document.getElementById('radio' + counter).checked = true;
                counter++;
                if(counter > 4){
                    counter = 1;
                }
            }, 5000);
            </script>
        </section>
    <section class="desc" id="desc">
        <center>
            <p><span style="font-family: PlayfairDisplay, serif; font-size: 45px; 
                color: rgb(40, 40, 40);" 
                data-mce-style="font-family: PlayfairDisplay_Bold, Tahoma; 
                font-size: 52px; color: #282828;">KUDAPANNYA</span></p>
            <p>Sesuai namanya<b>—Kudapannya—</b>menjual berbagai macam kudapan atau 
            camilan yang dibuat secara <i>home made</i>. Adapun produknya berupa pastry, seperti kue kering (nastar, kastengel, putri salju) dan bakery seperti bolu, coffee bun, dan lain-lain.</p>
        </center>
    </section>
    <section class="menuproduct">
        <div>
        <center>
            <p><span style="font-family: PlayfairDisplay, serif; font-size: 45px; 
                color: rgb(40, 40, 40);" 
                data-mce-style="font-family: PlayfairDisplay_Bold, Tahoma; 
                font-size: 52px; color: #282828;">MENU</span></p>
        </center>
            <main class="grid">
                <article>
                <a>
                    <img src="/images/nastar.png" class="menuimg" width="300px" height="300px">
                </a>
                    <div class="content">
                        <h2>Kue Kering</h2>
                        <center><p>Nastar</p></center>
                        <center><p>Putri Salju</p></center>
                        <center><p>Lidah Kucing</p></center>
                        <center><p>Cookies</p></center>
                        <center><p>Macaron</p></center>
                    </div>
                </article>
                <article>
                <a>
                    <img src="/images/croissant.jpg" class="menuimg" width="300px" height="300px">
                </a>
                    <div class="content">
                        <h2>Kue dan Pastry</h2>
                        <center><p>Coffee Bun</p></center>
                        <center><p>Croissant</p></center>
                        <center><p>Eclair</p></center>
                        <center><p>Donut</p></center>
                        <center><p>Sponge Cake</p></center>
                        <center><p>Brownies</p></center>
                    </div>
                </article>
                <article>
                <a>
                    <img src="/images/sandwich.jpg" class="menuimg" width="300px" height="300px">
                </a>
                    <div class="content">
                        <h2>Roti dan Sandwich</h2>
                        <center><p>Toast</p></center>
                        <center><p>Sandwich</p></center>
                        <center><p>White Bread</p></center>
                        <center><p>Wheat Bread</p></center>
                    </div>
                </article>
        </main>    
        </div>
    </section>
    @if(session('username'))
    <script>
        alert("Hai, {{ session('username') }}! Enjoy your shopping!");
        {!! Session::forget('username') !!}
    </script>
    @endif

    @if(session('successpayment'))
    <script>
        alert("{{session('successpayment')}}");
    </script>
    @endif
@endsection
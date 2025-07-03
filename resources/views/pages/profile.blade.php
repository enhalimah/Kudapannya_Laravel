@if(session('incorrect'))
    <script>
        alert("{{ session('incorrect') }}");
    </script>
@endif

@if(session('alert-success'))
    <script>
        alert("{{session('alert-success')}}");
    </script>
@endif

@if(session('failedsignup'))
    <script>
        alert("{{session('failedsignup')}}");
    </script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/styleprofile.css">
    <title>signin-signup</title>
</head>
<body class="profile">
    <div>
    <nav class="nav">
        <a href="homepage"><img src="/images/kudapan.png" width="60" height="60" class="logo"></a>
        <div class="menu">
            <ul>
                <li><a href="homepage">Home</a></li>
                <li><a href="product">Product</a></li>
                <li><a href="about-us">About Us</a></li>
                <li><a href="profile">Profile</a></li>
            </ul>
        </div>
    </nav>
</div>
    <div class="container">
        <div class="signin-signup">
            <form method='POST' action="/signin" class="sign-in-form">
                @csrf
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Name/Email" value="{{ Session::get('email')}}" name="email" class="form-control @error('email') is-invalid @enderror" id="email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password">
                </div>
                <input type="submit" value="Login" class="btn">
                <p class="account-text">Don't have an account? <a href="#" id="sign-up-btn2">Sign up</a></p>
            </form>
            <form method='POST' action="/signup" class="sign-up-form">
                @csrf
                <h2 class="title">Sign up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Name" name="name">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" placeholder="Email" name="email">
                </div>
                <div class="input-field">
                    <i class="fas fa-phone"></i>
                    <input type="text" placeholder="Phone" name="phone">
                </div>
                <div class="input-field">
                    <i class="fas fa-map-marker"></i>
                    <input type="text" placeholder="Address" name="address">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" placeholder="Password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" placeholder="Confirm Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">
                </div>
                <input type="submit" value="Sign up" class="btn">
                <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Member of Kudapannya?</h3>
                    <p>Already have an account? Let's sign in!</p>
                    <button class="btn" id="sign-in-btn">Sign in</button>
                </div>
                <img src="/images/cooking.png" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>New to Brand?</h3>
                    <p>Let's join as a member of Kudapannya and you can buy "Kudapannya" from wherever you are!</p>
                    <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
                <img src="/images/cooking (1).png" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
@extends('layoutsadmin')

@section('maincontentadmin')
<main role="main">
  
  <section class="panel important">
        @if(session('username'))
            <div class="greeting">
                <center>
                    <h2>Hai, {{ session('username') }}! Selamat Bekerja!</h2>
                </center>
            </div>
        @endif
  </section>
</main>
@endsection
@extends('layoutsadmin')

@section('maincontentadmin')
<link rel="stylesheet" href="/css/styleadmin.css">
</head>
<body>
<main role="main">
        <section class="panel important">
            <center><h1>User</h1></center>
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Detail</th>
                </tr>
            </thead>
            @foreach ($data as $user)
            <tbody>
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form onsubmit="return confirm('Are you sure to delete this user?');" action="/user/{{$user->id}}" method="POST">
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
@if(session('successuser'))
    <script>
        alert("{{session('successuser')}}");
    </script>
@endif
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("assets/css/login.css")}}">
</head>
<body>
    {{-- menampilkan error validasi --}}
    @if ($errors->any())
    <ul style="width:100%; background: red; padding: 10px;">
        @foreach ($errors->all() as $error)
            <li> {{$error}} </li>
        @endforeach
    </ul>
@endif
{{-- munculin pemberitahuan gagal login --}}
@if (Session::get('gagal'))
    <div style="width: 100%; background: red; padding: 10px;">
        {{Session::get('gagal')}}
    </div>
@endif


    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="{{route("auth")}}" method="POST">
        @csrf
        <h3>Login Here</h3>
        <label for="username">Email</label>
        <input type="text" name="email" placeholder="Email or Phone" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password">
        <button>Log In</button>
    </form>
</body>
</html>

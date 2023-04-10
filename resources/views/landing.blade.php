<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegadaian Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
</head>
<body>

    <header>
        {{-- @if (Auth::check())
            @if (Auth::user()->role == 'admin')
                <a href="{{route('data')}}" class="login-btn">Lihat Data</a>
            @elseif (Auth::user()->role == 'petugas')
                <a href="{{route('dashboard')}}" class="login-btn">Lihat Data</a>
            @endif

        @else
            <a href="{{route('login')}}" class="login-btn">Administrator</a>
        @endif --}}
    </header>



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pegadaian</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li>
                        <a class="nav-link" href="#"></a>
                         @if (Auth::check())
                            @if (Auth::user()->role == 'admin')
                                <a href="{{route('data')}}" class="login-btn">Lihat Data</a>
                            @elseif (Auth::user()->role == 'petugas')
                                <a href="{{route('dashboard')}}" class="login-btn">Lihat Data</a>
                            @endif
                            @else
                            <a href="{{route('login')}}" class="login-btn">Login</a>
                        @endif 
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Pegadaian</h1>
                <p>Lorem Ipsum, or lipsum as it is sometimes known, is Dumpy text used in laying out printed graphic or web disign. The passage is at attribute to an unknown type in 5th.</p>
            </div>
        </div>
    </div>

    <div class="image-box">
        <img src="{{asset("assets/img/Pegadaian-Foto.jpg")}}" alt="gambar" />
        <div class="description">
          <h2>Our Vision</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          </p>
        </div>
    </div>

    <div class="counter-container">
        <div class="counter-item">
          <div class="count" id="visitors">500+</div>
          <div class="label">Visitors</div>
        </div>
        <div class="counter-item">
          <div class="count" id="liked">95%</div>
          <div class="label">Liked</div>
        </div>
        <div class="counter-item">
          <div class="count" id="propose">440+</div>
          <div class="label">Propose</div>
        </div>
        <div class="counter-item">
          <div class="count" id="previews">350+</div>
          <div class="label">Previews</div>
        </div>
    </div>      

    <div class="container mt-5">
        <h2>Form Input Pegadaian</h2>
        <p>Silahkan isi data di bawah ini untuk melakukan proses Pegadaian</p>

        @if ($errors->any())
        <ul style="width:100%; background: red; padding: 10px;">
            @foreach ($errors->all() as $error)
                <li> {{$error}} </li>
            @endforeach
        </ul>
        @endif
        
        @if (Session::get('success'))
        <ul style="width:100%; background: green; padding: 10px;">
            {{ Session::get('success') }}
        </ul>
        @endif

        <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" name="age" id="age" placeholder="Enter your age">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" placeholder="Enter your NIK">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="item" class="form-label">Item</label>
                        <input type="text" class="form-control" name="item" id="item" placeholder="Enter the item you want to loan">
                    </div>
                    <div class="mb-3">
                        <label for="item-photo" class="form-label">Item Photo</label>
                        <input type="file" class="form-control" name="foto" id="item-photo">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-send">Send Data</button>
        </form>
    </div>
    
    <footer class="bg-dark text-light mt-5 py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2023 Pegadaian. All Rights Reserved.</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script>{{asset("assets/js/script.js")}}</script> --}}
</body>
</html>    



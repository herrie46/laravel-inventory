<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Herrie Effendi">
    <title>Key Online Inventory</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2/css/bootstrap.min.css')}}">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-25 m-auto">
    <form method="post" action="{{ route('kirim-data-login')}}">
        @csrf
        <img class="mb-4" src="{{asset('image/instagram.png')}}" alt="" width="72" height="57">
        <br> {{$errors->first('email')}}
        <h1 class="h3 mb-3 fw-normal">Silahkan Login</h1>
        <div class="form-floating">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <br>
    <button class="btn btn-primary w-100 py-2" type="submit">Masuk</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
    </form>
    </main>
<script src="{{asset('bootstra-5.3.2/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>

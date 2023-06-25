<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/sass/app.scss')
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>
<body class="bg-primary">
    <div class="container-sm">
        <div class="row justify-content-center">
            <div class="col-md-4 col-xl-4">
                <div class="card p-4 mb-4">
                    <div class="mb-3 mt-3 text-center">
                        <i class="bi bi-hexagon-fill fs-1 text-primary"></i>
                        <h4>Employee Data Master</h4>
                    </div>
                    <div class="card-body p-3 mb-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-12 mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Your Password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>

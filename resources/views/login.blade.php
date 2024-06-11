<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">


    <main class="background-login overflow-hidden d-flex">

        <div class="container d-flex   px-md-5 align-items-center text-lg-start ">
            <div class="row gx-lg-5 align-items-center mb-5 mt-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Welcome to <br><span style="margin-left: 20%">Cine World</span>
                    </h1>
                    <p class="mb-4 opacity-70 text-light">
                        Here, you can easily discover the movies and TV shows you love. Let's explore the fascinating
                        world of cinema together and indulge in a delightful audio-visual experience!
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">

                    <div class="card bg-dark">
                        <div class="card-body px-4 py-5 px-md-5">
                            <div class="text-center">
                                <img src="{{ asset('images/logo.png') }}" style="width: 185px;" alt="logo">

                            </div>
                            <br>
                            <form method="POST" action="{{ route('login.submit') }}">
                                @csrf
                                <!-- Email input -->
                                <div class="form-outline mb-4 text-light">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Password input -->
                                <div class="form-outline mb-4 text-light">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror" />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-center mb-4 text-danger">
                                    @if (session('error'))
                                        <span>{{ session('error') }}</span>
                                    @endif
                                </div>
                                <div class="text-center d-grid  mb-5 pb-1">
                                    <input type="submit" value="Login"
                                        class="btn btn-danger btn-block btn-lg gradient-custom-4 text-light">
                                    <a class="text-end text-danger" href="{{ route('forgotPassword.submit') }}">Forgot
                                        password?</a>
                                </div>
                                <!-- Register buttons -->
                                <div class="text-center text-light">
                                    <p>Don't have an account? <a href="{{ route('register') }}"
                                            class="fw-bold text-danger">Register here</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


</body>

</html>

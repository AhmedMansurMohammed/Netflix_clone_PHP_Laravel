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
        <div class="container d-flex align-items-center py-5">
            <div class="container ">
                <div class="row d-flex justify-content-center align-items-center ">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 ">
                        <div class="card bg-dark" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center text-light mb-5">Create account</h2>

                                <form action="{{ route('register.submit') }}" method="post">
                                    @csrf

                                    <div class="form-outline mb-4 text-light">
                                        <label class="form-label" for="name">Your Name</label>
                                        <input type="text" id="name" name="name" value="{{old('name')}}"
                                            class="form-control form-control-lg @error('name') is-invalid @enderror" />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4 text-light">
                                        <label class="form-label" for="email">Your Email</label>
                                        <input type="text" id="email" name="email" value="{{old('email')}}"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror" />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4 text-light">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" 
                                            class="form-control form-control-lg @error('password') is-invalid @enderror" />
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4 text-light">
                                        <label class="form-label" for="repassword">Repeat your password</label>
                                        <input type="password" id="repassword" name="password_confirmation"
                                            class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline mb-4 text-light">
                                        <label class="form-label" for="phone">Phone Number</label>
                                        <input type="text" id="phone_number" name="phone_number" value="{{old('phone_number')}}"
                                            class="form-control form-control-lg @error('phone_number') is-invalid @enderror" />
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-check d-flex justify-content-center mb-5 text-light checkbox checkbox-red">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                            id="check" />
                                        <label class="form-check-label " for="check">
                                            I agree all statements in <a href="#!" class="text-light"><u>Terms of
                                                    service</u></a>
                                        </label>
                                    </div>

                                    <div class="text-light d-grid  mb-5 pb-1">
                                        <input type="submit" value="Sign Up"
                                            class="btn btn-danger btn-block btn-lg gradient-custom-4 text-light">
                                    </div>

                                    <p class="text-center mt-5 mb-0 text-light">Have already an account? <a
                                            href="{{ route('login') }}" class="fw-bold text-danger">Login here</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


</body>

</html>

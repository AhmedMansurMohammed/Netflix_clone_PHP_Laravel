@extends('layouts.header')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center alert-dismissible">
            <a href="{{ route('profile') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif

    @if (Session::has('update'))
        <div class="alert alert-success text-center alert-dismissible">
            <a href="{{ route('profile') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ Session::get('update') }}</p>
        </div>
    @endif
    

    <section class="vh-100" style="background-color: #f4f5f7;">
        @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-12 mb-4">
                    <div class="card my-3" style="border-radius: .5rem; height:80vh">
                        <div class="row g-0" style="height: 100%">
                            <div
                                class="col-md-4 background-custom text-center text-white d-flex flex-column justify-content-evenly align-items-center">
                                <img src="{{ asset('images/user-logo.png') }}" alt="Avatar" class="img-fluid my-5"
                                    style="width: 80px;" />
                                <div>
                                    <h5>{{ session('email') }}</h5>
                                    <br>
                                    <br>
                                    <p class="text-dark h3">Type of subscription</p>
                                    <p class="text-uppercase">
                                        @if ($latestSubscription = auth()->user()->subscriptions()->latest()->first())
                                            <p>{{ $latestSubscription->type->type }}</p>
                                        @else
                                            <p>FREE</p>
                                        @endif
                                    </p>
                                    <p class="text-dark h4">Expiration Date</p>
                                    <p class="text-uppercase">
                                        @if ($latestSubscription = auth()->user()->subscriptions()->latest()->first())
                                            <p>{{ $latestSubscription->expire_date }}</p>
                                        @else
                                            <p>UNLIMITED</p>
                                        @endif
                                    </p>
                                </div>

                                <div class="d-grid">
                                    <a href="{{ route('subscription') }}" class="btn btn-dark text-uppercase mb-2">Choose
                                        Plan</a>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center ">
                                        <h1>Information</h1>
                                        <button id="editButton" class="btn">
                                            <i class="far fa-edit"></i> Edit
                                        </button>
                                    </div>
                                    <hr class="mt-0 mb-4">
                                    <form id="editForm" method="POST" action="{{ route('update.profile') }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control form-control-lg" value="{{ $user->name }}" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" id="password" name="password"
                                                    class="form-control form-control-lg" value="{{ $user->password }}"
                                                    disabled>
                                                <button class="btn btn-outline-secondary" type="button" id="showPassword">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="phone">Phone Number</label>
                                            <input type="phone" id="phone_number" name="phone_number"
                                                class="form-control form-control-lg" value="{{ $user->phone_number }}"
                                                disabled />
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="text" id="address" name="address"
                                                class="form-control form-control-lg" value="{{ $user->address }}"
                                                disabled />
                                        </div>

                                        <button type="submit" id="saveButton" class="btn btn-primary"
                                            style="display: none;">Save</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('editButton').addEventListener('click', function() {
            document.querySelectorAll('input').forEach(function(input) {
                input.disabled = false;
            });
            document.getElementById('saveButton').style.display = 'block';
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">


                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">

                                    <h5 class="card-title text-center pb-0 fs-4">Login To System</h5>
                                </div>

                                <form class="row g-3 needs-validation" action="{{ route('login') }}" method="POST"
                                    novalidate>
                                    @csrf

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="email" class="form-control" id="yourUsername">
                                            <div class="invalid-feedback">Please enter your email.</div>
                                        </div>
                                        @error('email')
                                            <div>

                                                <p class="text-danger">{{ $message }}</p>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">password</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">
                                                <i class="bx bxs-lock"></i>
                                            </span>
                                            <input type="password" name="password" class="form-control "
                                                id="yourpassword">
                                        </div>
                                        @error('password')
                                            <div>

                                                <p class="text-danger">{{ $message }}</p>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
</main>
@endsection

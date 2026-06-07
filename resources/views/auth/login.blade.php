@extends('frontend.layout.app')

@section('content')


    <section class="min-vh-100 d-flex align-items-center py-5">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100 g-4">


                <div class="col-md-9 col-lg-6 col-xl-5 d-none d-md-block" data-aos="fade-right">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>

                <div class="col-12 col-md-8 col-lg-6 col-xl-4 offset-xl-1">


                    @if(session()->has('error'))
                        <div class="alert alert-danger mb-4">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" data-aos="fade-left" >
                        @csrf


                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-lg-start gap-2">
                            <p class="lead fw-normal mb-2 mb-sm-0 me-sm-3">Sign in with</p>
                            <div class="d-flex gap-2">
                                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-floating">
                                    <i class="fab fa-linkedin-in"></i>
                                </button>
                            </div>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                        </div>

                        <style>
                            .divider:after,
                            .divider:before {
                                content: "";
                                flex: 1;
                                height: 1px;
                                background: #ced4da;
                            }
                        </style>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" />
                            <label class="form-label" for="form3Example3">Email address</label>
                            @error('email')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3">
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <label class="form-label" for="form3Example4">Password</label>
                            @error('password')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                       
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg w-100 w-lg-auto"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-3 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}"
                                    class="link-danger">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

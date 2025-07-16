@extends('layouts.frontend')

@section('content')
<section class="py-5">
    <div class="container px-5">
        <!-- Contact form-->
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-shield-lock-fill"></i></div>
                <h1 class="fw-bolder">Login</h1>
                <p class="lead fw-normal text-muted mb-0">Please enter your username and password to log in to the admin page!</p>
            </div>
            
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form action="{{ route('login') }}" method="POST" accept-charset="utf-8">
                        @csrf
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <input id="email" type="email" name="email" :value="old('email')" class="form-control" placeholder="Email" required autofocus autocomplete="username">
                            <label for="email" :value="__('Email')">Email</label>
                            <p :messages="$errors->get('email')" class="text-danger"></p>
                        </div>
                        
                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password" required autocomplete="current-password" >
                            <label for="password" :value="__('Password')">Password</label>
                            <p :messages="$errors->get('password')" class="text-danger"></p>
                        </div>      
                        
                        <div class="d-none" id="submitErrorMessage">
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                            @endif
                        </div>
                            
                            <!-- Submit Button-->
                            {{-- <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ ('Log in') }}
                                </button>
                            </div> --}}
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg" id="submitButton" type="submit">{{ ('Log in') }}</button>
                            </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

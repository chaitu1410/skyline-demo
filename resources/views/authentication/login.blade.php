@extends('layouts.main', ['header' => 'auth', 'footer' => false])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Sign In')

@section('content')

     <!-- breadcrumb start -->
<nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sign In</li>

    </ol>
</nav>
<!-- breadcrumb ends -->

    <!-- login form start -->
    <div class="registeruserform mt-0 mb-4">
        <h4 class="mb-4 text-center">
            Sign In
        </h4>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Mobile Number<span
                        class="mandatoryfield">*</span>
                </label>
                <input type="text" class="form-control" id="exampleFormControlInput2" name="mobile" value="{{ old('mobile') }}">
            </div>
          
            <div class="mb-3">
                <label for="exampleFormControlInput4" class="form-label">Password<span
                        class="mandatoryfield">*</span>
                </label>
                <input type="password" class="form-control" id="exampleFormControlInput4" name="password">
            </div>

            <div class="forgetpwdlink">
                <a href="{{ route('forgot.password') }}">Forgot Password ?</a>
            </div>

            <div class="registerloginbtn mb-2">
                <button class="btn w-100" type="submit">Login</button>
            </div>

            <div class="signupinlink">
                <a href="{{ route('register') }}">Don't Have Account? Click To Sign Up</a>
            </div>

            <div>
                <span class="text-secondary small">
                    By continuing, you agree to Skyline's Terms and Conditions and the 
                    Privacy Policy.
                </span>
            </div>

        </form>
    </div>
    <!-- login form ends -->

@endsection
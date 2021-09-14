@extends('layouts.main', ['header' => 'auth', 'footer' => false])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Password Reset')

@section('content')

   <!-- breadcrumb start -->
   <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Reset Password</li>

    </ol>
</nav>
<!-- breadcrumb ends -->


<!-- password reset form start -->
<div class="registeruserform mt-0 mb-4">
    <h4 class="mb-4 text-center">
        Password Assistance
    </h4>

    @livewire('forgot-password')
</div>
<!-- password reset form ends -->

@endsection
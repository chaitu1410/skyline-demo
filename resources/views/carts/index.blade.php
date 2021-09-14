@extends('layouts.main', ['header' => 'small', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Your Cart')

@section('content')

    <!-- breadcrumb start -->
  <nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Your Cart</li>

    </ol>
  </nav>
  <!-- breadcrumb ends -->

  @livewire('cart-list')
  

@endsection
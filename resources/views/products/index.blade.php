@extends('layouts.main', ['header' => 'full', 'footer' => false])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Skyline Distributors | Aurangabad - Products')

@section('content')

<!-- breadcrumb start -->
<nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pb-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="allcategories.html">Products</a></li>
    </ol>
</nav>
<!-- breadcrumb ends -->

<livewire:product-list :query="$query">
{{-- @livewire('product-list', ['query' => $query]) --}}

<!-- filter sidebar ends -->

@endsection
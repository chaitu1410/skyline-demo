@extends('layouts.main', ['header' => 'full', 'footer' => false])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', $brand->name)

@section('content')

<!-- breadcrumb start -->
<nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pb-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item">{{ $brand->name }}</li>
    </ol>
</nav>
<!-- breadcrumb ends -->


@livewire('brand-product-list', ['query' => $query, 'brand' => $brand->id])

@endsection
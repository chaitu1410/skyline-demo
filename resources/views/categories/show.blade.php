@extends('layouts.main', ['header' => 'full', 'footer' => false])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Skyline Distributors | Aurangabad - Details')

@section('content')

<!-- breadcrumb start -->
<nav id="breadcrumbproductinfo" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="pb-0">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">All Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
    </ol>
</nav>
<!-- breadcrumb ends -->

@livewire('category-product-list', ['query' => $query, 'category' => $category->id])

@endsection
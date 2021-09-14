@extends('layouts.special', ['headertitle' => 'All Categories', 'footer' => true])

@section('ogtitle', 'Skyline Distributors | Aurangabad')
@section('title', 'Skyline Distributors | Aurangabad - Categories')

@section('content')

<!-- categories start -->
<section>
    <div id="allcategoriescont">

        @forelse ($categories as $category)    
            <div class="categoryitem card" onclick="location.href='{{ route('categories.show', $category) }}'">
                <div class="categoryimg">
                    <img src="{{ asset('images/'.$category->image ) }}" alt="{{ $category->name }}">
                </div>
                <div class="categoryname">
                    <p class="mb-0">{{ $category->name }}</p>
                </div>
            </div>
        @empty
            <p>Categories not added</p>
        @endforelse


    </div>
</section>
<!-- categories end -->

@endsection
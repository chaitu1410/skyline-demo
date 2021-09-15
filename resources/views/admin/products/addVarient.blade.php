@extends('admin.layouts.main')

@section('content')
<!-- Page content-->
<livewire:admin.add-varient :query="$query">
{{-- @livewire('admin.add-varient') --}}
<!-- Page content ends-->
@endsection
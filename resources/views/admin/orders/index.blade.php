@extends('admin.layouts.main')

@section('content')
    <!-- Page content-->
    <div class="container-fluid">

        <div class="allcontents bg-white p-2 mt-2">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumblinks">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Status</li>
                </ol>
            </nav>


            <div class="dataaddactions">
                <div class="addcategorybtns btn-group">
                    <button class="btn btn-secondary btn-sm" onclick="location.href=''">Print</button>
                    <button class="btn btn-secondary btn-sm" onclick="location.href=''">Download PDF</button>
                </div>
                <!-- searchbar -->
                <form action="{{ route('admin.orders.index') }}">
                    <div id="datasearchbar" class="input-group mt-3 mb-3">
                        <input type="hidden" name="status" value="{{$status}}">
                        <input type="text" class="form-control" placeholder="Search Orders"
                        aria-label="Recipient's username" aria-describedby="button-addon2" name="query">
                        <button class="btn orangebg" type="submit" id="button-addon2">
                            <span class="material-icons">
                                search
                            </span>
                        </button>
                    </div>
                </form>
            </div>


            <!-- table -->
            <div class="bg-white mt-2">

                <div id="catvisetabs" class="mt-2">
                    <ul class="nav nav-tabs" id="tabcategory" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if($status == config('constants.orderStatus.ordered')) active @endif categorytabhead" data-bs-toggle="tab"
                                data-bs-target="#cat1" type="button" role="tab" aria-controls="cat1"
                                aria-selected="true" onclick="location.href='{{ route('admin.orders.index', ['status' => config('constants.orderStatus.ordered')]) }}'">New Orders</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link categorytabhead @if(!($status == config('constants.orderStatus.ordered')) && !($status == config('constants.orderStatus.delivered')) && !($status == config('constants.orderStatus.cancelled')) && !($status == config('constants.orderStatus.returned'))) active @endif" data-bs-toggle="tab" data-bs-target="#cat2"
                                type="button" role="tab" aria-controls="cat1" aria-selected="true" onclick="location.href='{{ route('admin.orders.index', ['status' => config('constants.orderStatus.accepted')]) }}'">Orders In
                                Progress</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link categorytabhead @if($status == config('constants.orderStatus.delivered')) active @endif" data-bs-toggle="tab" data-bs-target="#cat3"
                                type="button" role="tab" aria-controls="cat1" aria-selected="true" onclick="location.href='{{ route('admin.orders.index', ['status' => config('constants.orderStatus.delivered')]) }}'">
                                Delivered Orders</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link categorytabhead @if($status == config('constants.orderStatus.cancelled')) active @endif" data-bs-toggle="tab" data-bs-target="#cat3"
                                type="button" role="tab" aria-controls="cat1" aria-selected="true" onclick="location.href='{{ route('admin.orders.index', ['status' => config('constants.orderStatus.cancelled')]) }}'">
                                Cancelled Orders</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link categorytabhead @if($status == config('constants.orderStatus.returned')) active @endif" data-bs-toggle="tab" data-bs-target="#cat3"
                                type="button" role="tab" aria-controls="cat1" aria-selected="true" onclick="location.href='{{ route('admin.orders.index', ['status' => config('constants.orderStatus.returned')]) }}'">
                                Returned Orders</button>
                        </li>
                    </ul>
                </div>

                <div id="alldatatable" class="tab-content pt-4" id="proTabContent">

                    @if ($status == config('constants.orderStatus.ordered'))
                        <x-admin.new-orders :query="$query"/>
                    @elseif($status == config('constants.orderStatus.delivered'))
                        <x-admin.delivered-orders :query="$query"/>
                    @elseif($status == config('constants.orderStatus.cancelled'))
                        <x-admin.cancelled-orders :query="$query"/>
                    @elseif($status == config('constants.orderStatus.returned'))
                        <x-admin.returned-orders :query="$query"/>
                    @else
                        <x-admin.orders-in-progress :query="$query"/>
                    @endif

                </div>

            </div>

            
        </div>

    </div>
    <!-- Page content ends-->
@endsection
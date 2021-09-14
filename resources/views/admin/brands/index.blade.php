@extends('admin.layouts.main')

@section('content')
<!-- Page content-->
<div class="container-fluid">
    <div class="allcontents bg-white p-2 mt-2">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumblinks">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Brands</li>
            </ol>
        </nav>


        <div class="dataaddactions mb-4">

            <div class="addcategorybtns">
                <button class="btn bluebg btn-sm" data-bs-toggle="modal" data-bs-target="#addbrandmodal">+
                    Add Brand</button>
            </div>
            <!-- searchbar -->
            <form id="datasearchbar" method="GET" class="input-group mt-3 mb-3">
                <input type="text" name="query" class="form-control" placeholder="Search Brands"
                    aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn orangebg" type="submit" id="button-addon2">
                    <span class="material-icons">
                        search
                    </span>
                </button>
            </form>
        </div>

            @if (count($brands) > 0)
                <!-- table -->
            <div id="alldatatable" class="bg-white mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Brand Name</th>
                            <th>Brand Logo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td class="col-md-2">
                                    <div class="tablecellwidthbq">
                                        <p class="mb-0">{{ $brand->name }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="brandlogoimg">
                                        <img src="{{ asset('images/'.$brand->image) }}" alt="{{ $brand->name }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex">
                                        <button class="btn bluebg btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editbrandmodal{{ $brand->id }}">
                                            <span class="material-icons">
                                                edit
                                            </span>
                                        </button>

                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteconfirmmodal{{ $brand->id }}">
                                            <span class="material-icons">
                                                delete
                                            </span>
                                        </button>
                                    </div>

                                </td>
                            </tr>

                            <!--modal for edit brand starts -->
                            <div class="modal fade" id="editbrandmodal{{ $brand->id }}" tabindex="-1" aria-labelledby="editbrandmodalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Brand
                                                        Name</label>
                                                    <input type="text" name="name" class="form-control form-control-sm" id="exampleFormControlInput1"
                                                        value="{{ $brand->name }}">
                                                </div>
    
                                                <div class="mb-3">
                                                    <label for="formFileSm" class="form-label">Upload Brand
                                                        Logo</label>
                                                    <input class="form-control form-control-sm" id="formFileSm" type="file" name="image">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn bluebg btn-sm">Update Brand</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--modal for edit brand ends-->

                            <!--modal for delete confirm starts -->
                            <div class="modal fade" id="deleteconfirmmodal{{ $brand->id }}" tabindex="-1" aria-labelledby="deleteconfirmmodalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Brand</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <p>Are you sure that you want to delete ?</p>
                                            </div>

                                        </div>
                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!--modal for delete confirm ends-->
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- pagination -->
            <nav aria-label="Page navigation example justify-content-end">
                {{ $brands->appends(request()->query())->links('pagination::bootstrap-4') }}
            </nav>
            @else
                <p>No brands available...</p>
            @endif
    </div>

</div>

<!-- add brand modal starts -->
<div class="modal fade" id="addbrandmodal" tabindex="-1" aria-labelledby="addcategorymodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Brand
                            Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" id="exampleFormControlInput1">
                    </div>
    
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Upload Brand
                            Logo</label>
                        <input type="file" name="image" class="form-control form-control-sm" id="formFileSm">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bluebg btn-sm">Add/Save Brand</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- add brand modal ends -->

<!-- Page content ends-->
@endsection
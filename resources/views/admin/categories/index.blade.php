@extends('admin.layouts.main')

@section('content')
<!-- Page content-->
<div class="container-fluid">



    <div class="allcontents bg-white p-2 mt-2">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumblinks">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>

        <div class="dataaddactions">
            <div class="addcategorybtns">
                <button class="btn bluebg btn-sm" data-bs-toggle="modal"
                    data-bs-target="#addcategorymodal">+ Add Category</button>
            </div>
            <!-- searchbar -->
            <form id="datasearchbar" method="GET" class="input-group mt-3 mb-3">
                <input type="text" name="query" class="form-control" placeholder="Search Categories"
                    aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn orangebg" type="submit" id="button-addon2">
                    <span class="material-icons">
                        search
                    </span>
                </button>
            </form>
        </div>
        

        <!-- table -->
        <div id="alldatatable" class="bg-white mt-2 pt-3">
            <div id="allcategories">

                @forelse ($categories as $category)
                    <div class="categoryitemcont">
                        <div class="categoryitem" onclick="location.href='{{ route('admin.categories.show', $category->id) }}'">
                            <div class="categoryimg">
                                <img src="{{ asset('images/'.$category->image) }}" alt="">
                            </div>

                            <div class="categoryname">
                                <p class="mb-1">{{ $category->name }}</p>
                            </div>
                        </div>
                        <div class="categoryactions">
                            <div class="categoryaction" onclick="location.href='category.html'">
                                <span class="material-icons text-dark">
                                    visibility
                                </span>
                            </div>
                            <div class="categoryaction" data-bs-toggle="modal"
                                data-bs-target="#category{{ $category->id }}">
                                <span class="material-icons text-dark">
                                    edit
                                </span>
                            </div>

                            <div class="categoryaction" data-bs-toggle="modal"
                                data-bs-target="#deletecategorymodal{{ $category->id }}">
                                <span class="material-icons text-danger">
                                    delete
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- edit category modal starts -->
                    <div class="modal fade" id="category{{ $category->id }}" aria-labelledby="editcategorymodalLabel{{ $category->id }}"
                        aria-hidden="true">
                        <form action="{{ route('admin.categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="formFileSm" class="form-label">Upload Category Image</label>
                                            <input type="file" name="image" class="form-control form-control-sm" id="formFileSm">
                                        </div>
                        
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Category
                                                Name</label>
                                            <input type="text" name="name" class="form-control form-control-sm" id="exampleFormControlInput1"
                                                value="{{ $category->name }}">
                                        </div>
                        
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="bestSeller" type="checkbox" id="flexSwitchCheckDefault" @if($category->bestSeller)checked @endif>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Mark as a
                                                Best Seller Category</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn bluebg btn-sm">Update Category</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                        <!--modal for delete product starts -->
                        <div class="modal fade" id="deletecategorymodal{{ $category->id }}" tabindex="-1" aria-labelledby="deletecategorLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <p>Are you sure that you want to delete this category?</p>
                                        </div>

                                    </div>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    {{-- <x-admin.edit-category  :category="$category"/> --}}
                @empty
                    Categories not available...
                @endforelse

            </div>

        </div>

        <!-- pagination -->
        <nav aria-label="Page navigation example  justify-content-end">
            {{ $categories->appends(request()->query())->links('pagination::bootstrap-4') }}
        </nav>

    </div>

</div>

{{-- add category --}}
<div class="modal fade" id="addcategorymodal" tabindex="-1" aria-labelledby="addcategorymodalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Upload Category Image</label>
                            <input type="file" name="image" class="form-control form-control-sm" id="formFileSm">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Category
                                Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" id="exampleFormControlInput1">
                        </div>

                        <div class="form-check form-switch">
                            <input type="checkbox" name="bestSeller" class="form-check-input" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Mark as a
                                Best Seller Category</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bluebg btn-sm">Add/Save Category</button>
                    </div>
                </div>
        </form>
        </div>
    </div>
    <!-- add category modal ends -->

<!-- Page content ends-->
@endsection
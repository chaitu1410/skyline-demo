@extends('admin.layouts.main')

@section('content')
<!-- Page content-->
<div class="container-fluid">
    <div class="allcontents bg-white p-2 mt-2">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumblinks">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>

        <div class="dataaddactions">
            <div class="addcategorybtns">
                <button class="btn bluebg btn-sm" data-bs-toggle="modal"
                    data-bs-target="#addsubcategorymodal">+ Add Sub-Category</button>

                <button class="btn bluebg btn-sm" onclick="location.href='{{ route('admin.products.create', $category->id) }}'">+ Add
                    Product</button>
            </div>
            
        </div>

        <!-- table -->
        <div id="alldatatable" class="bg-white mt-5 pt-3">
            <div id="catvisetabs">
                <ul class="nav nav-tabs" id="tabcategory" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link @if(!($subcategory)) active @endif categorytabhead"
                            role="tab" aria-controls="cat1"
                            aria-selected="true" href="{{ route('admin.categories.show', ['category' => $category->id]) }}">All Products</a>
                    </li>
                    @forelse ($subcategories as $index => $sub)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link @if($sub == $subcategory) active @endif categorytabhead"
                                role="tab" aria-controls="cat1"
                                aria-selected="true" href="{{ route('admin.categories.showSubcategory', ['category' => $category->id ,'subcategory' => $sub->id ]) }}">{{ $sub->name }}</a>
                        </li>
                    @empty
                        No subcategories available in this category...
                    @endforelse

                </ul>
            </div>

            <div class="tab-content" id="proTabContent">

                <div class="tab-pane fade show active" id="cat1" role="tabpanel" aria-labelledby="home-tab">
                    @if ($subcategory)
                        <div class="editsubcategorybtns d-flex">
                            <div class="editsubcatpart">
                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#editsubcategorymodal">Edit Subcategory</button>
                            </div>
                            <div class="editsubcatpart">
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deletesubcategorymodal">Delete Subcategory</button>
                            </div>
                        </div>
                    @endif
                    <div class="productscategorytabcont">
                        @if ($subcategory)
                            @forelse ($subcategory->products as $product)
                                <div class="procard card">
                                    <div class="prod-img" onclick="location.href=''">
                                        <img src="{{ asset('images/'.$product->image) }}" class="" alt="...">
                                    </div>

                                    <div class="productdetails" onclick="location.href=''">
                                        <a>
                                            <p class="prodname">{{ $product->name }}</p>
                                        </a>
                                        <p class="mb-0 text-success prodprice"><span
                                                class="cutprice text-danger">{{ $product->mrp }} </span> {{ $product->sellingPrice }}
                                        </p>
                                    </div>
                                    <div class="productactions">
                                        <div class="prodaction">
                                            <span id="prodview" class="material-icons text-dark">
                                                visibility
                                            </span>
                                        </div>

                                        <div class="prodaction" onclick="location.href='{{ route('admin.products.edit', $product->id) }}'">
                                            <span id="prodedit" class="material-icons text-dark">
                                                edit
                                            </span>
                                        </div>

                                        <div class="prodaction">
                                            <span id="proddelete" class="material-icons text-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteproductmodal{{ $product->id }}">
                                                delete
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!--modal for delete product starts -->
                                <div class="modal fade" id="deleteproductmodal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteproductLabel"
                                aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Product Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <p>Are you sure that you want to delete this product?</p>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--modal for delete product ends-->
                            @empty
                                No products available in this subcategory...
                            @endforelse
                        @else
                            @forelse ($category->products as $product)
                            <div class="procard card">
                                <div class="prod-img" onclick="location.href=''">
                                    <img src="{{ asset('images/'.$product->image) }}" class="" alt="...">
                                </div>

                                <div class="productdetails" onclick="location.href=''">
                                    <a>
                                        <p class="prodname">{{ $product->name }}</p>
                                    </a>
                                    <p class="mb-0 text-success prodprice"><span
                                            class="cutprice text-danger">{{ $product->mrp }} </span> {{ $product->sellingPrice }}
                                    </p>
                                </div>
                                <div class="productactions">
                                    <div class="prodaction">
                                        <span id="prodview" class="material-icons text-dark">
                                            visibility
                                        </span>
                                    </div>

                                    <div class="prodaction" onclick="location.href='{{ route('admin.products.edit', $product->id) }}'">
                                        <span id="prodedit" class="material-icons text-dark">
                                            edit
                                        </span>
                                    </div>

                                    <div class="prodaction">
                                        <span id="proddelete" class="material-icons text-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteproductmodal{{ $product->id }}">
                                            delete
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!--modal for delete product starts -->
                            <div class="modal fade" id="deleteproductmodal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteproductLabel"
                            aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Product Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <p>Are you sure that you want to delete this product?</p>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                
                            @endforelse

                        @endif
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add sub category modal starts -->
<div class="modal fade" id="addsubcategorymodal" tabindex="-1" aria-labelledby="addcategorymodalLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.subcategories.store', $category->id) }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Sub-Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="field_wrapper">
                        <div class="d-flex mb-3">
                            <input type="text" class="form-control form-control-sm" placeholder="Add Subcategory "
                                name="subcategory">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bluebg btn-sm">Add/Save Sub-Category</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- add category modal ends -->

@if ($subcategory)
    <!-- edit sub category modal starts -->
    <div class="modal fade" id="editsubcategorymodal" tabindex="-1" aria-labelledby="editcategorymodalLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.subcategories.update', $subcategory) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Sub-Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
            
                        <div class="d-flex mb-3">
                            <input type="text" class="form-control form-control-sm" placeholder="Add Subcategory "
                                name="subcategory" value="{{ $subcategory->name }}">
                        </div>
            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bluebg btn-sm">Update Sub-Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- edit category modal ends -->

    <!-- delete confirm modal starts -->
    <div class="modal fade" id="deletesubcategorymodal" tabindex="-1" aria-labelledby="deletecategorymodalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form action="{{ route('admin.subcategories.destroy', ['category' => $category, 'subcategory' => $subcategory]) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Sub-Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <p class="mb-2">Are you sure that you want to delete this subcategory ?</p>
                            <p class="mb-0">
                                <small class="text-danger">Note: All the products in this subcategory will be
                                    deleted.</small>
                            </p>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- delete confirm modal ends -->
@endif




<!-- Page content ends-->
@endsection
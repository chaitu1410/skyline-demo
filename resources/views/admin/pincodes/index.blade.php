@extends('admin.layouts.main')

@section('content')
    <!-- Page content-->
    <div class="container-fluid">



        <div class="allcontents bg-white p-2 mt-2">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumblinks">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cities and Pincodes</li>
                </ol>
            </nav>
            <!-- <div class="panelheading">
                <p>Users</p>
            </div> -->


            <div class="dataaddactions mb-4">

                <div class="addcategorybtns">
                    <button class="btn bluebg btn-sm" data-bs-toggle="modal" data-bs-target="#addcitymodal">+
                        Add City</button>
                </div>
                <!-- searchbar -->
                <form>
                    <div id="datasearchbar" class="input-group mt-3 mb-3">
                        <input type="text" name="query" class="form-control" placeholder="Search Cities"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn orangebg" type="submit" id="button-addon2">
                            <span class="material-icons">
                                search
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- table -->
            <div id="alldatatable" class="bg-white mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Pincode</th>
                            <th>Delivery Charge</th>
                            <th>Free Delivery Limit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pincodes as $pincode)
                        <tr>
                            <td>{{ $pincode->id }}</td>
                            <td>{{ $pincode->state }}</td>
                            <td>{{ $pincode->city }}</td>
                            <td>{{ $pincode->pincode }}</td>
                            <td>{{ $pincode->deliveryCharge }}</td>
                            <td>@if($pincode->freeDeliveryLimit) {{ $pincode->freeDeliveryLimit }} @else Not Applicable @endif</td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn bluebg btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editcitymodal{{ $pincode->id }}">
                                        <span class="material-icons">
                                            edit
                                        </span>
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteconfirmmodal{{ $pincode->id }}">
                                        <span class="material-icons">
                                            delete
                                        </span>
                                    </button>
                                </div>

                            </td>
                        </tr>


                        <div class="modal fade" id="editcitymodal{{ $pincode->id }}" tabindex="-1" aria-labelledby="editcitymodalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.pincodes.update', $pincode) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">State
                                                    Name</label>
                                                <select id="states" name="state" class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
                                                    <option>Open this select menu</option>
                                                    <option selected value="{{ $pincode->state }}">{{ $pincode->state }}</option>    
                                                </select>
                                            </div>   
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">City
                                                    Name</label>
                                                <select id="cities" name="city" class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>  
                                                    <option>Open this select menu</option>
                                                    <option selected value="{{ $pincode->city }}">{{ $pincode->city }}</option>    
                                                </select>
                                            </div>
                                       
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">
                                                    Pincode
                                                </label>
                                                <input type="number" name="pincode" class="form-control form-control-sm" id="exampleFormControlInput1" value="{{ $pincode->pincode}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">
                                                    Delivery Charge
                                                </label>
                                                <input type="number" name="deliveryCharge" class="form-control form-control-sm" id="exampleFormControlInput1" value="{{ $pincode->deliveryCharge}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">
                                                    Free Delivery Limit<br><small>(If order total amount exceeds this value delivery charge will be free. Keep empty if above pincode doesn't support free delivery.')</small>
                                                </label>
                                                <input type="number" name="freeDeliveryLimit" class="form-control form-control-sm" id="exampleFormControlInput1" value="{{ $pincode->freeDeliveryLimit}}">
                                            </div>
                                        </div>   
                                        <div class="modal-footer">
                                            <button type="submit" class="btn bluebg btn-sm">Update Pincode</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="deleteconfirmmodal{{ $pincode->id }}" tabindex="-1" aria-labelledby="deleteconfirmmodalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete City</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <p>Are you sure that you want to delete ?</p>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.pincodes.destroy', $pincode) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @empty
                            
                        @endforelse
                        
                    </tbody>
                </table>




            </div>

            <!-- pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-end">
                    {{ $pincodes->appends(request()->query())->links('pagination::bootstrap-4') }}
                </ul>
            </nav>
        </div>

    </div>
    <!-- Page content ends-->

    <!-- add city modal starts -->
    <div class="modal fade" id="addcitymodal" tabindex="-1" aria-labelledby="addcitymodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @livewire('admin.pincode-form')
            </div>
        </div>
    </div>
    <!-- add city modal ends -->

@endsection
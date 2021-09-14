@extends('admin.layouts.main')

@section('content')
<!-- Page content-->
<div class="container-fluid">
    <div class="allcontents bg-white p-2 mt-2">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumblinks">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bulk Quote Requests</li>
            </ol>
        </nav>


        <div class="dataaddactions">
            <div class="addcategorybtns btn-group">
                <button class="btn btn-secondary btn-sm" onclick="location.href=''">Print</button>
                <button class="btn btn-secondary btn-sm" onclick="location.href=''">Download PDF</button>
            </div>
            <!-- searchbar -->
            <form>
                <div id="datasearchbar" class="input-group mt-3 mb-3">
                    <input type="text" name="query" class="form-control" placeholder="Search Requests"
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
                        <th>Company</th>
                        <th>Username</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Pincode</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($quotes as $quote)
                        <tr>
                            <td class="col-md-2">
                                <div class="tablecellwidthbq">
                                    <p class="mb-0">{{ $quote->company }}</p>
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="tablecellwidthbq">
                                    <p class="mb-0">{{ $quote->customerName }}</p>
                                </div>
                            </td>

                            <td>{{ $quote->mobile }}</td>
                            <td class="col-md-2">
                                <div class="tablecellwidthbq">
                                    <p class="mb-0">{{ $quote->email }}</p>
                                </div>
                            </td>
                            <td>{{ $quote->pincode }}</td>

                            <td class="col-md-2">{{ $quote->city }}</td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn bluebg btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#viewusermodal{{ $quote->id }}">
                                        View & Reply
                                    </button>
                                </div>

                            </td>
                        </tr>
                        <!--modal for bulk quote request reply starts -->
                        <div class="modal fade" id="viewusermodal{{ $quote->id }}" tabindex="-1" aria-labelledby="viewusermodalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Bulk Quote Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="d-flex mb-4">
                                            <h6 class="fw-bold">User's Request</h6>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">
                                                User's Buying Requirement & Qty.
                                            </label>
                                            <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="5"
                                                readonly>{{ $quote->requirement }}</textarea>
                                        </div>
                                        @if ($quote->clientQuotationFile)    
                                            <div class="mb-3">
                                                <div class="downloadbulkpdficon">
                                                    <span class="material-icons">
                                                        file_download
                                                    </span>
                                                    <a href="{{ asset('files/'.$quote->clientQuotationFile ) }}">
                                                        <span>
                                                            Download User's Quotation
                                                        </span>
                                                    </a>

                                                </div>
                                            </div>
                                        @endif

                                        <hr>

                                        <div class="d-flex mb-4">
                                            <h6 class="fw-bold">Reply To User's Request</h6>
                                        </div>
                                        <form action="{{ route('admin.quotes.reply', $quote) }}" method="POST" enctype="multipart/form-data"> 
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Reply:
                                                </label>
                                                <textarea id="editor" name="reply" class="small" placeholder="Type here...">{{ $quote->reply }}</textarea>
                                            </div>
                                            @if (!($quote->reply))
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">
                                                        Upload Quotation
                                                    </label>
                                                    <input class="form-control form-control-sm" id="formFileSm" type="file" name="file">
                                                </div>
                                                <button class="btn btn-sm orangebg float-end">Send Message</button>

                                            @else
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">
                                                        Uploaded File
                                                    </label>
                                                    <a href="{{ asset('files/'.$quote->adminQuotationFile ) }}">
                                                        <span>
                                                            Download Your Quotation
                                                        </span>
                                                    </a>
                                                </div>
                                            @endif
                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--modal for bulk quote request reply ends-->
                    @empty
                        <p>No quotes posted yet</p>
                    @endforelse

                </tbody>
            </table>


        </div>

        <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end">
                {{ $quotes->appends(request()->query())->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>

</div>
<!-- Page content ends-->
@endsection
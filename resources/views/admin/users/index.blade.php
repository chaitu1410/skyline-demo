@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="allcontents bg-white p-2 mt-2">

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumblinks">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>

        <div class="dataaddactions">
            <div class="addcategorybtns btn-group">
                <button class="btn btn-secondary btn-sm" onclick="location.href='{{ route('admin.users.download') }}'">Download Excel</button>
            </div>
            <!-- searchbar -->
            <form>
                <div id="datasearchbar" class="input-group mt-3 mb-3">
                    <input type="text" name="query" class="form-control" placeholder="Search Users"
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
                        <th>Name</th>
                        <th>Trade/Company Name</th>
                        <th>Contact No. 1</th>
                        <th>Contact No. 2</th>
                        <th>GST No.</th>
                        <th>Email</th>
                        <th>Reg. Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="col-md-2">
                                <div class="tablecellwidthbq">
                                    <p class="mb-0">{{ $user->name }}</p>
                                </div>
                            </td>
                            <td class="col-md-2">
                                <div class="tablecellwidthbq">
                                    <p class="mb-0">{{ $user->company }}</p>
                                </div>
                            </td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->mobile2 }}</td>
                            <td>{{ $user->gstNumber }}</td>
                            <td class="col-md-2">
                                <div class="tablecellwidthbq">
                                    <p class="mb-0">{{ $user->email }}</p>
                                </div>
                            </td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <p>No users added yet</p>
                    @endforelse

                </tbody>
            </table>


        </div>

        <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm justify-content-end">
                {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>

</div>
<!-- Page content ends-->
@endsection
<div>
    <!-- table -->
<div id="alldatatable" class="bg-white mt-2 pt-3">
    <div id="allcategories">

        @forelse ($categories as $category)
            <div wire:key="{{ $category->id }}" class="categoryitemcont">
                <div class="categoryitem" onclick="location.href='category.html'">
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
                    <button class="categoryaction" wire:click="onEditClick({{ $category->id }})">
                        <span class="material-icons text-dark">
                            edit
                        </span>
                    </button>

                    <div class="categoryaction" data-bs-toggle="modal"
                        data-bs-target="#deletecategorymodal">
                        <span class="material-icons text-danger">
                            delete
                        </span>
                    </div>
                </div>
            </div>

            
            {{-- <x-admin.edit-category  :category="$category"/> --}}
        @empty
            Categories not available...
        @endforelse

        <!-- edit category modal starts -->
        <div class="modal fade modal" id="" tabindex="-1" aria-labelledby="editcategorymodalLabel"
            @if ($showModal) aria-hidden="true" @endif >
                <x-admin.edit-category />
        </div>

    </div>

</div>

<!-- pagination -->
<nav aria-label="Page navigation example">
    <ul class="pagination pagination-sm justify-content-end">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item active" aria-current="page">
            <span class="page-link">1</span>
        </li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
</div>

<div>
    <div id="filtersortoptions">
    <a id="filterbtntoggle" class="btn" onclick="myFunction()">
        <span class="material-icons">
            filter_alt
        </span>
        <span>
            Filter Products
        </span>
    </a>

    <select class="form-select" aria-label="sort" wire:model="sort">
        <option value="">All</option>
        <option value="ASC">Sort By Price : Low</option>
        <option value="DESC">Sort By Price : High</option>
        <option value="LATEST">Sort By Latest</option>
    </select>

</div>


<!-- filter sidebar starts -->
<div id="filterproductssection">
    <div id="filtersidebarbody">
        <button class="btn bluebg w-100 mb-4" wire:click="removeFilters">Remove Filters</button>
        <label class="form-label">Product Categories</label>
        <select class="form-select" aria-label="Default select example" wire:model="category">
            <option selected value="">Open this select menu</option>
            @forelse ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @empty
            @endforelse
        </select>
        <hr>

        <label class="form-label">Sub Category</label>
        <select class="form-select" aria-label="Default select example" wire:model="subcategory">
            <option selected value="">Open this select menu</option>
            @forelse ($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
            @empty
            @endforelse
        </select>
        <hr>

        <label for="customRange3" class="form-label">Filter By Price</label>
        <div class="minmaxprice d-flex">
            <input type="text" class="form-control" id="input2" placeholder="Min. Price" wire:model="min"> 
            -
            <input type="text" class="form-control" id="input3" placeholder="Max. Price" wire:model="max">
        </div>

        <button class="btn bluebg w-100 mt-4" wire:click="removeFilters">Remove Filters</button>
    </div>
    <div id="filteredproducts">
        <div class="productscategorytabcont">

            @forelse ($products as $product)
                <div class="procard card">
                    <h1 class="discount">{{ $product->discount }}%</h1>
                    <div class="prod-img">
                        <img src="{{ asset('images/'.$product->image ) }}" class="" alt="..."
                            onclick="location.href='{{ route('products.show', $product) }}'">
                    </div>

                    <div class="productdetails" onclick="location.href='{{ route('products.show', $product) }}'">
                        <a href="{{ route('products.show', $product) }}">
                            <p class="prodname">{{ $product->name }}</p>
                        </a>
                        <img src="{{ asset('images/'.$product->brand->image) }}" alt="{{$product->brand->name}}">
                        <p class="mb-0 text-success prodprice"><span class="cutprice text-danger">₹{{ $product->mrp }} </span> ₹{{ $product->sellingPrice }}
                        </p>
                    </div>
                </div>
            @empty
                <p>No products available...</p>
            @endforelse
            
        </div>
        <div  id="productspagination" >
            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div> 
    </div>
</div>


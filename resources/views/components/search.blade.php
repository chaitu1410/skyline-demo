<div class="searchbargrp">
    <form action="{{ route('products.index') }}" method="get">
        <div class=" input-group">
            <input type="text" name="query" class="form-control" placeholder="Search For Products And Categories"
                aria-label="Recipient's username" aria-describedby="button-addon2">
            <button id="sbarbtn" class="btn" type="submit" >
                <span class="material-icons">
                search
                </span>
            </button>
        </div>
    </form>
</div>
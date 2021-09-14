<div class="form-check mt-4 singleproductcancel">
    <div class="yourcartitem w-100 cancelorderproductitem">
        <input class="form-check-input checkboxproductitem" type="checkbox" value="{{ $orderproduct->id }}" name="products[]" wire:model="checkbox" id="return-checkbox1">
        <div class="yourordersproductimg">
            <img src="{{ asset('images/'.$orderproduct->product->image) }}" alt="">
        </div>

        <div class="yourordersproductinfo">
            <p class="mb-2 yourordersprodname">{{ $orderproduct->product->name }}</p>
            <p class="mb-2 text-secondary yourordersprodname small">Variant : {{ $orderproduct->varient->name }}</p>
            <p class="mb-2 text-secondary small">Qty: {{ $orderproduct->quantity }}</p>
            <p class="mb-0 fw-bold text-success">₹{{ $orderproduct->product->sellingPrice }}</p>
        </div>
    </div>
    @if ($visible)    
        <div class="cancelreasoncont mt-3">
            <div class="mb-3">
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="reasons[]">
                    <option selected value="Was delivered in a physically damaged condition">Was delivered in a physically damaged condition</option>
                    <option value="Has missing parts or accessories">Has missing parts or accessories</option>
                    <option value="Is different from what was ordered">Is different from what was ordered</option>
                    <option value="Is no longer needed (subject to acceptance by us)">Is no longer needed (subject to acceptance by us)</option>
                </select>
            </div>
            <div id="textarea-reason">
                <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="5"
                    placeholder="Write detailed reason to cancel this order" name="detailedReasons[]"></textarea>
            </div>
        </div>
    @endif
</div>
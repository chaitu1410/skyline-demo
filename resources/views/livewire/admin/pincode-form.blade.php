<form action="{{ route('admin.pincodes.store') }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">State
                Name</label>
            <select id="states" name="state" class="form-select form-select-sm" aria-label=".form-select-sm example" wire:model="selectedState">
                <option value="-1">Open this select menu</option>
                @forelse ($states as $state)
                    <option value="{{ $state['name'] }}">{{ $state['name'] }}</option>    
                @empty
                    
                @endforelse
            </select>
        </div>
        @if ($selectedState)     
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">City
                    Name</label>
                <select id="cities" name="city" class="form-select form-select-sm" aria-label=".form-select-sm example" wire:model="selectedCity">
                    <option value="-1">Open this select menu</option>
                    @forelse ($cities as $city)
                        <option value="{{ $city['name'] }}">{{ $city['name'] }}</option>    
                    @empty
                        
                    @endforelse
                </select>
            </div>
        @endif

        @if ($selectedCity)    
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">
                    Pincode
                </label>
                <input type="number" name="pincode" class="form-control form-control-sm" id="exampleFormControlInput1" wire:model="pincode">
                @if (session()->has('success'))
                    <span class="text-success">
                        {{ session('success') }}
                    </span>
                @endif
                @if (session()->has('error'))
                    <span class="text-danger">
                        {{ session('error') }}
                    </span>
                @endif
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">
                    Delivery Charge
                </label>
                <input type="number" name="deliveryCharge" class="form-control form-control-sm" id="exampleFormControlInput1" wire:model="deliveryCharge">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">
                    Free Delivery Limit<br><small>(If order total amount exceeds this value delivery charge will be free. Keep empty if above pincode doesn't support free delivery.')</small>
                </label>
                <input type="number" name="freeDeliveryLimit" class="form-control form-control-sm" id="exampleFormControlInput1">
            </div>
        @endif
    </div>
    @if ($validPincode && $deliveryCharge)    
        <div class="modal-footer">
            <button type="submit" class="btn bluebg btn-sm">Add/Save City</button>
        </div>
    @endif
</form>
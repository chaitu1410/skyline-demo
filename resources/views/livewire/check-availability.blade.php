<div class="checkavailibilitypincode checkpincodeprodinfo">

    <p><strong>Check Availability At Your Location</strong></p>
    <div class="input-group mt-3">
      <input type="text" class="form-control" placeholder="Enter Your Pincode" aria-label="Recipient's username"
        aria-describedby="button-addon2" wire:model="pincode">
      <button class="btn btn-secondary" type="button" id="button-addon2" wire:click="check">
        Check
      </button>
    </div>
    <span>
        <small>
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
        </small>
    </span>

  </div>

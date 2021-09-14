<form action=""{{ route('forgot.password.post') }} method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Mobile Number
        </label>
        <div id="inputforgetotp">
            <div class="inputforgetotpip">
                <input type="text" class="form-control" id="exampleFormControlInput2" name="mobile" wire:model="mobile">
            </div>
           <div class="inputforgetotpbtn">
            <button id="getotpbtn" class="btn btn-success" wire:click.prevent="getOTP">Get OTP</button>
           </div>
        </div>
        @if (session()->has('sent'))
            <span class="text-success">
                {{ session('sent') }}
            </span>
        @endif
        @if (session()->has('notfound'))
            <span class="text-danger">
                {{ session('notfound') }}
            </span>
        @endif
    </div>

    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Verify OTP
        </label>
        <div id="inputforgetotp">
            <div class="inputforgetotpip">
                <input type="text" class="form-control" id="exampleFormControlInput2" name="otp" wire:model="otp">
            </div>
           <div class="inputforgetotpbtn">
            <button id="getotpbtn" class="btn btn-success" wire:click.prevent="verifyOTP">Verify</button>
           </div>
        </div>
        @if (session()->has('correctOTP'))
            <span class="text-success">
                {{ session('correctOTP') }}
            </span>
        @endif
        @if (session()->has('incorrectOTP'))
            <span class="text-danger">
                {{ session('incorrectOTP') }}
            </span>
        @endif
    </div>

    @if ($verified)
        <div class="mb-3">
            <label for="exampleFormControlInput4" class="form-label">Create New Password
            </label>
            <input type="password" class="form-control" id="exampleFormControlInput4" name="password">
        </div>


        <div class="mb-4">
            <label for="exampleFormControlInput4" class="form-label">Confirm New Password
            </label>
            <input type="password" class="form-control" id="exampleFormControlInput4" name="password_confirmation">
        </div>


        <div class="registerloginbtn mb-2">
            <button class="btn w-100">Save</button>
        </div>


        <div>
            <span class="text-secondary small">
                By continuing, you agree to Skyline's Terms and Conditions and the Privacy Policy.
            </span>
        </div>
    @endif

</form>
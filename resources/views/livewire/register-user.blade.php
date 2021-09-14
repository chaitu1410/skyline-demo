<form action="{{ route('register.post') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label">Mobile Number
        </label>
        <div id="inputforgetotp">
            <div class="inputforgetotpip">
                <input type="text" class="form-control" id="exampleFormControlInput2" name="mobile" wire:model="mobile" value="{{ old('mobile') }}">
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
        @if (session()->has('taken'))
            <span class="text-danger">
                {{ session('taken') }}
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
            <button id="getotpbtn" class="btn btn-success"  wire:click.prevent="verifyOTP">Verify</button>
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
            <label for="exampleFormControlInput1" class="form-label">Full Name<span class="mandatoryfield">*</span>
            </label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="exampleFormControlInput3" name="email" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput4" class="form-label">Create Password<span
                    class="mandatoryfield">*</span>
            </label>
            <input type="password" class="form-control" id="exampleFormControlInput4" name="password">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput5" class="form-label">Confirm Password<span
                    class="mandatoryfield">*</span>
            </label>
            <input type="password" class="form-control" id="exampleFormControlInput5" name="password_confirmation">
        </div>

        <div class="registerloginbtn mb-2">
            <button class="btn w-100">Register</button>
        </div>
    @endif

    <div class="signupinlink">
        <a href="{{ route('login') }}">Already Have Account? Click To Sign In</a>
    </div>

    <div>
        <span class="text-secondary small">
            By continuing, you agree to Skyline's Terms and Conditions and the

            <a id="privacypolicylink" data-bs-toggle="modal" data-bs-target="#exampleModal">Privacy Policy</a>.
        </span>
    </div>

</form>

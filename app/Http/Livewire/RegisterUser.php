<?php

namespace App\Http\Livewire;

use App\Models\Otp;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\VerifiedMobileNumber;

class RegisterUser extends Component
{
    public $mobile = "";
    public $otp = "";
    public $verified = false;

    public function mount()
    {
        $this->mobile = old('mobile') ?? "";
    }

    public function getOTP()
    {
        if (!validatePhoneNumber($this->mobile)) {
            session()->flash('sent', 'Enter valid mobile number');
            return;
        }

        $user = User::where('mobile', '=', $this->mobile)->first();
        if ($user !== null) {
            session()->flash('taken', 'This mobile number is already taken');
            return;
        }

        $record = Otp::where('mobile', '=', $this->mobile)->first();
        $otp = strval(rand(100000, 999999));
        $time = Carbon::now()->subMinutes(15)->toDateTimeString();

        if ($record !== null) {
            if (!($record->updated_at >= $time)) {

                $response = sendSMS($this->mobile, $otp, 'otp');

                if ($response->successful() && $response['Status'] == 'Success') {
                    $record->update([
                        'otp' => $otp
                    ]);
                    session()->flash('sent', 'OTP sent successfully!');
                } else {
                    session()->flash('sent', 'Failed to send OTP');
                }
            } else {
                session()->flash('sent', 'Use previous OTP or wait for 15 minutes and then try');
            }
        } else {

            $response = sendSMS($this->mobile, $otp, 'otp');

            if ($response->successful() && $response['Status'] == 'Success') {
                Otp::create([
                    'mobile' => $this->mobile,
                    'otp' => $otp
                ]);
                session()->flash('sent', 'OTP sent successfully!');
            } else {
                session()->flash('sent', 'Failed to send OTP');
            }
        }
        //session()->flash('sent', 'OTP sent successfully!');
        //request()->session()->flash('success', 'OTP sent successfully, OTP will be valid for next 15 minutes!');
    }

    public function verifyOTP()
    {
        if (!validatePhoneNumber($this->mobile)) {
            session()->flash('sent', 'Enter valid mobile number');
            return;
        } elseif (!validateOTP($this->otp)) {
            session()->flash('incorrectOTP', 'Invalid OTP');
            return;
        }

        $record = Otp::where('mobile', '=', $this->mobile)->where('otp', '=', $this->otp)->first();
        if ($record !== null) {

            $verifiedMobile = VerifiedMobileNumber::where('mobile', '=', $this->mobile)->first();
            if ($verifiedMobile !== null) {
                $verifiedMobile->update([
                    'updated_at' => Carbon::now()
                ]);
            } else {
                VerifiedMobileNumber::create([
                    'mobile' => $this->mobile
                ]);
            }
            $this->verified = true;
            session()->flash('correctOTP', 'OTP verified!');
        } else {
            session()->flash('incorrectOTP', 'Incorrect OTP');
        }
    }

    public function render()
    {
        return view('livewire.register-user');
    }
}

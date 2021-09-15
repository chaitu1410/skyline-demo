<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\VerifiedMobileNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthenticationsController extends Controller
{
    public function login()
    {
        return view('authentication.login');
    }



    public function loginPost(LoginRequest $request)
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();
            $request->session()->flash('success', 'Logged in successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to login');
            return back();
        }
        return redirect()->intended(route('home'));
    }



    public function register()
    {
        return view('authentication.register');
    }



    public function registerPost(RegisterRequest $request)
    {
        try {
            $verifiedNumber = VerifiedMobileNumber::where('mobile', '=', $request->mobile)->first();
            $time = Carbon::now()->subHours(1);

            if ($verifiedNumber !== null) {
                if ($verifiedNumber->updated_at >= $time) {
                    DB::transaction(function () use ($request) {
                        $user = User::create([
                            'name' => $request->get('name'),
                            'mobile' => $request->get('mobile'),
                            'email' => $request->get('email'),
                            'password' => Hash::make($request->get('password')),
                        ]);
                        $user->address()->create([]);
                        event(new Registered($user));
                        Auth::login($user);
                    });
                    $request->session()->flash('success', 'Registered and logged in successfully!');
                    return redirect(route('home'));
                } else {
                    $request->session()->flash('error', 'Mobile number verification expired, please re-verify mobile number');
                    return back();
                }
            } else {
                $request->session()->flash('error', 'Mobile number is not verified');
                return back();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to regiter');
            return back();
        }
    }


    public function forgotPassword()
    {
        return view('authentication.forgotpassword');
    }

    public function forgotPasswordPost(EditPasswordRequest $request)
    {
        try {
            $verifiedNumber = VerifiedMobileNumber::where('mobile', '=', $request->mobile)->first();
            $time = Carbon::now()->subHours(1);
            $user = User::where('mobile', '=', $request->mobile)->first();

            if ($verifiedNumber !== null) {
                if ($verifiedNumber->updated_at >= $time) {
                    $user->update([
                        'password' => Hash::make($request->password),
                    ]);

                    $request->session()->flash('success', 'Password reset successfully!');
                    return redirect(route('login'));
                } else {
                    $request->session()->flash('error', 'Mobile number verification expired, please re-verify mobile number');
                    return back();
                }
            } else {
                $request->session()->flash('error', 'Mobile number is not verified');
                return back();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to set new password');
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->flash('success', 'Logged out successfully!');
        return redirect(route('home'));
    }
}

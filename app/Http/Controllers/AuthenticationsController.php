<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\VerifiedMobileNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\EditPasswordRequest;

class AuthenticationsController extends Controller
{
    public function login()
    {
        return view('authentication.login');
    }



    public function loginPost(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $request->session()->flash('success', 'Logged in successfully!');
        return redirect()->intended(route('home'));
    }



    public function register()
    {
        return view('authentication.register');
    }



    public function registerPost(RegisterRequest $request)
    {
        $verifiedNumber = VerifiedMobileNumber::where('mobile', '=', $request->mobile)->first();
        $time = Carbon::now()->subHours(1);

        if ($verifiedNumber !== null) {
            if ($verifiedNumber->updated_at >= $time) {
                $user = User::create([
                    'name' => $request->get('name'),
                    'mobile' => $request->get('mobile'),
                    'email' => $request->get('email'),
                    'password' => Hash::make($request->get('password')),
                ]);
                $user->address()->create([]);

                event(new Registered($user));
                Auth::login($user);

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
    }


    public function forgotPassword()
    {
        return view('authentication.forgotpassword');
    }

    public function forgotPasswordPost(EditPasswordRequest $request)
    {
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

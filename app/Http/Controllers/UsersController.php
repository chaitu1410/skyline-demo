<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditUserRequest;

class UsersController extends Controller
{
    public function edit()
    {
        $data['user'] = Auth::user();
        $data['address'] = Auth::user()->address;
        return view('users.edit', $data);
    }

    public function update(EditUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $user->update([
                'name' => $request->get('name'),
                'mobile2' => $request->get('mobile2'),
                'gstNumber' => $request->get('gst'),
                'company' => $request->get('company'),
            ]);

            $user->address()->update([
                'pincode' => $request->get('pincode'),
                'town' => $request->get('town'),
                'area' => $request->get('area'),
                'houseNumber' => $request->get('houseNumber'),
                'landmark' => $request->get('landmark'),
            ]);
            DB::commit();
            $request->session()->flash('success', 'Profile updated successfully!');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to update profile');
        }
        return back();
    }
}

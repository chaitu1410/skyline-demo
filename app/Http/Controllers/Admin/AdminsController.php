<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Quote;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ContactDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditContactDetailRequest;

class AdminsController extends Controller
{
    public function dashboard()
    {
        $data['totalUsers'] = User::count();
        $data['totalProducts'] = Product::count();
        $data['totalOrders'] = Order::where('isPaid', true)->count();
        $data['totalQuotes'] = Quote::count();
        $data['banners'] = Banner::all();
        return view('admin.dashboard', $data);
    }

    public function storeBanner(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                throw new Exception('Error occured');
                foreach ($images as $img) {
                    $imgName = 'banner_' . getRandomName() . '.' . $img->getClientOriginalExtension();
                    Banner::create([
                        'image' => $imgName
                    ]);
                    $img->move(public_path('images'), $imgName);
                }
            }
            DB::commit();
            $request->session()->flash('success', 'Banner images added successfully!');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to add banner image');
        }
        return back();
    }

    public function destroyBanner(Request $request, Banner $banner)
    {
        try {
            deleteImage($banner->image);
            $banner->delete();
            $request->session()->flash('success', 'Banner images deleted successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to delete banner image');
        }
        return back();
    }

    public function edit(Request $request)
    {
        $data = [];
        try {
            $details = ContactDetail::first();
            if (!($details)) {
                ContactDetail::create();
                $details = ContactDetail::first();
            }
            $data['details'] = $details;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to get data');
            return back();
        }
        return view('admin.information', $data);
    }

    public function update(EditContactDetailRequest $request)
    {
        try {
            ContactDetail::first()->update([
                'CutomerSupportContactNumber' => $request->get('customerSupportContact'),
                'SalesContactNumber' => $request->get('salesContact'),
                'OtherQueryContactNumber' => $request->get('otherQueryContact'),
                'CutomerSupportEmail' => $request->get('costomerSupportEmail'),
                'SalesEmail' => $request->get('salesEmail'),
                'OtherQueryEmail' => $request->get('otherQueryEmail'),
                'OfficeAddress' => $request->get('officeAddress'),
            ]);
            $request->session()->flash('success', 'Contact details updated successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to edit contact information');
        }
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditContactDetailRequest;
use App\Models\Banner;
use App\Models\ContactDetail;

class AdminsController extends Controller
{
    public function dashboard()
    {
        $data['totalUsers'] = User::count();
        $data['totalProducts'] = Product::count();
        $data['banners'] = Banner::all();
        return view('admin.dashboard', $data);
    }

    public function storeBanner(Request $request)
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $img) {
                $imgName = 'banner_' . getRandomName() . '.' . $img->getClientOriginalExtension();
                Banner::create([
                    'image' => $imgName
                ]);
                $img->move(public_path('images'), $imgName);
            }
        }

        $request->session()->flash('success', 'Banner images added successfully!');
        return back();
    }

    public function destroyBanner(Request $request, Banner $banner)
    {
        deleteImage($banner->image);
        $banner->delete();
        $request->session()->flash('success', 'Banner images deleted successfully!');
        return back();
    }

    public function edit()
    {
        $details = ContactDetail::first();
        if (!($details)) {
            ContactDetail::create();
            $details = ContactDetail::first();
        }
        $data['details'] = $details;
        return view('admin.information', $data);
    }

    public function update(EditContactDetailRequest $request)
    {
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
        return back();
    }
}

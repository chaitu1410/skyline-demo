<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pincode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditPincodeRequest;
use App\Http\Requests\StorePincodeRequest;
use Exception;

class PincodesController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query') ?? '';
        $pincodes = Pincode::query();
        $pincodes->where('pincode', 'like', '%' . $query . '%');
        $pincodes->orWhere('city', 'like', '%' . $query . '%');
        $pincodes->orWhere('state', 'like', '%' . $query . '%');
        $pincodes->orderBy('state', 'ASC');
        $pincodes->orderBy('city', 'ASC');
        $pincodes->orderBy('pincode', 'ASC');

        $data['pincodes'] = $pincodes->paginate(10);
        return view('admin.pincodes.index', $data);
    }

    public function store(StorePincodeRequest $request)
    {
        try {
            Pincode::create([
                'state' => $request->get('state'),
                'city' => $request->get('city'),
                'pincode' => $request->get('pincode'),
                'deliveryCharge' => $request->get('deliveryCharge'),
                'freeDeliveryLimit' => $request->get('freeDeliveryLimit'),
            ]);
            $request->session()->flash('success', 'City added successfully!');
        } catch (Exception $e) {
            $request->session()->flash('error', 'Failed to add city');
        }
        return redirect(route('admin.pincodes.index'));
    }

    public function update(EditPincodeRequest $request, Pincode $pincode)
    {
        try {
            $pincode->update([
                'pincode' => $request->get('pincode'),
                'deliveryCharge' => $request->get('deliveryCharge'),
                'freeDeliveryLimit' => $request->get('freeDeliveryLimit'),
            ]);
            $request->session()->flash('success', 'Pincode updated successfully!');
        } catch (Exception $e) {
            $request->session()->flash('error', 'Failed to add pincode');
        }
        return redirect(route('admin.pincodes.index'));
    }

    public function destroy(Pincode $pincode)
    {
        try {
            $pincode->delete();
            request()->session()->flash('success', 'City deleted successfully!');
        } catch (Exception $e) {
            request()->session()->flash('error', 'Failed to delete city');
        }
        return redirect(route('admin.pincodes.index'));
    }
}

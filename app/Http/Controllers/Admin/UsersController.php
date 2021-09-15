<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query') ?? '';
        $users = User::query();
        $users->where('name', 'like', '%' . $query . '%');
        $users->orWhere('mobile', 'like', '%' . $query . '%');
        $users->orWhere('mobile2', 'like', '%' . $query . '%');

        $data['users'] = $users->paginate(15);
        return view('admin.users.index', $data);
    }

    public function download(Request $request)
    {
        try {
            return Excel::download(new UsersExport, 'users_' . Carbon::now() . '.xlsx');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to download list');
        }
    }
}

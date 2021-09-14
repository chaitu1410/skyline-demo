<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Support\Carbon;
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

    public function download()
    {
        return Excel::download(new UsersExport, 'users_' . Carbon::now() . '.xlsx');
    }
}

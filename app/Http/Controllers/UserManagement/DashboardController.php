<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        abort_if((auth()->user()->is_admin != 1),404);
        $users                  =   User::where('is_active',1);
        $data['users']          =   $users->get();
        $data['totalUsers']     =   $users->count();
        // dd($data['users']->count());
        return view('admin.UserManagement.dashboard',$data);
    }
}

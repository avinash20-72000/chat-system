<?php

namespace App\Http\Controllers;

use App\Models\UserCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TwoFAController extends Controller
{
    public function index()
    {
        if (!Session::has('user_2fa_sent')) {
            auth()->user()->generateCode();
        }
        
        return view('2fa');
    }
  
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);
  
        $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)
                        ->where('updated_at', '>=', now()->subMinutes(3))
                        ->first();
        
        if (!is_null($find)) {
            Session::put('user_2fa', auth()->user()->id);
            return redirect()->route('chatUsers');
        }
  
        return back()->with('error', 'You entered wrong code.');
    }

    public function resend()
    {
        auth()->user()->generateCode();
        return back()->with('success', 'We sent you code on your email.');
    }
}

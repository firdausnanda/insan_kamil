<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    public function impersonate(User $user)
    {
        Auth::user()->impersonate($user);
        return redirect()->route('user.order.konfirmasi');    
    }

    public function leaveImpersonate() 
    {
        Auth::user()->leaveImpersonation();
        return redirect()->route('admin.pengguna.index'); 
    }
}

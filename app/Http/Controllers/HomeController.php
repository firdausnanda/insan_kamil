<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (Auth::user()->roles[0]->name) {
            case 'admin':
                return redirect('/admin');
                break;

            case 'superadmin':
                return redirect('/admin');
                break;
            
            default:
                return redirect('/');
                break;
        }
    }
}

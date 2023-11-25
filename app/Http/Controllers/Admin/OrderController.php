<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        return view('pages.admin.order.index');
    }
    
    public function detail() {
        return view('pages.admin.order.detail');
    }
}

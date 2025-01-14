<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetunjukController extends Controller
{
    public function index()
    {
        return view('pages.user.petunjuk.index');
    }
}

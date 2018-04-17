<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }
}

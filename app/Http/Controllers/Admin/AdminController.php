<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Gibt gibt den View zurück mit Admin Index
     * @return View admin.index
     */
    public function index() {
        return view('admin.index');
    }
}

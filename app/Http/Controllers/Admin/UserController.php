<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Gibt gibt den View zurück mit dem User Datatable
     * @return View admin.index
     */
    public function index() {
        return view('admin.users.index');
    }
}

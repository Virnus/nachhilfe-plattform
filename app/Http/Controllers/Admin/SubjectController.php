<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Gibt gibt den View zurück mit dem Subject Datatable
     * @return View admin.index
     */
    public function index() {
        return view('admin.subjects.index');
    }
}

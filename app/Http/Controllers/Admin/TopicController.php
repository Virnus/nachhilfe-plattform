<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    /**
     * Gibt gibt den View zurück mit dem Topic Datatable
     * @return View admin.index
     */
    public function index() {
        return view('admin.topics.index');
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Subject;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        return Subject::get();
    }
}

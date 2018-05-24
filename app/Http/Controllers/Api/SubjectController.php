<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Subject;

class SubjectController extends Controller
{
    /**
     * Gibt alle Fächer zurück
     * @return Response json
     */
    public function index()
    {
        return Subject::get();
    }
}

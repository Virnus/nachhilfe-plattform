<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Topic;

class TopicController extends Controller
{
    /**
     * Gibt alle Topics des gegebenen Fachs zurück
     * @param  Request $request
     * @return Response json
     */
    public function index(Request $request)
    {
        return Topic::bySubject($request)->byName($request)->pluck('name', 'id');
    }
}

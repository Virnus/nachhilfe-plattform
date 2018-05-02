<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Topic;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        return Topic::bySubject($request)->byName($request)->pluck('name', 'id');
    }
}

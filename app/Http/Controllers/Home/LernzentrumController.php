<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lernzentrum;

class LernzentrumController extends Controller
{
    protected $allLernzentrums;

    function __construct() {
        $this->allLernzentrums = Lernzentrum::isFuture()->orderBy('date', 'asc')->get();
    }

    public function index(Request $request)
    {
        $lernzentrum = $this->allLernzentrums->first();
        $allLernzentrums = $this->allLernzentrums;

        return view('home.lernzentrum', compact('lernzentrum', 'allLernzentrums'));
    }

    public function detail(Lernzentrum $lernzentrum)
    {
        $allLernzentrums = $this->allLernzentrums;

        return view('home.lernzentrum', compact('lernzentrum', 'allLernzentrums'));
    }
}

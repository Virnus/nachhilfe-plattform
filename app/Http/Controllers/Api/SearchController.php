<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\{ Angebot, User, Lernzentrum };

class SearchController extends Controller
{
    /**
     * Testet ob Angebote, Lernzentren oder Benutzer verfügbar sind die auf
     * den eigegeben Query-String zutreffend sind
     * Die gefundenen dateb werden als Json Response zurückgegeben
     * @param  Request $request [description]
     * @return Response json
     */
    public function index(Request $request) {
        $angebote = Angebot::filter($request->q)->get()
            ->makeHidden(['created_at', 'updated_at']);

        $lernzentrums = Lernzentrum::filter($request->q)->get()
            ->makeHidden(['teacher_id', 'created_at', 'updated_at']);

        $users = User::isActive()->filter($request->q)->get()
            ->makeHidden(['id', 'active', 'activation_token', 'created_at', 'updated_at']);

        return response()->json([
            'data' => [
                'angebote' => $angebote->take(5),
                'lernzentrum' => $lernzentrums->take(5),
                'users' => $users->take(5),
                'count' => [
                    'angebote' => $angebote->count(),
                    'lernzentrum' => $lernzentrums->count(),
                    'users' => $users->count()
                ]
            ]
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Participant;
use App\Term;

class IndexController extends Controller
{
    public function index(Request $request) {
        $terms = Term::all();
        $termCount = Term::count();
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));

        if($currentTermNr == 0) {
            $termNrsSoFar = range(1, $termCount);
        }
        else {
            $termNrsSoFar = range(1, $currentTermNr);
        }

        $termsSoFar = Term::find($termNrsSoFar);
        $winnerIds = array();

        foreach($termsSoFar as $term) {
            array_push($winnerIds, $term->winner_participant_id);
        }

        $winners = Participant::find($winnerIds);
        $winners = $winners->toArray();
        $winnersRightOrder = array();

        for($i = 0; $i < $termCount; $i++) {
            if(array_key_exists($i, $winners)) {
                $winnersRightOrder[$winners[$i]['term'] - 1] = $winners[$i]['name'];
            }
        }

        for($i = 0; $i < $termCount; $i++) {
            if(!array_key_exists($i, $winnersRightOrder)) {
                $winnersRightOrder[$i] = '???';
            }
        }

        return view('index', compact('terms', 'winnersRightOrder', 'currentTermNr', 'termCount'));
    }

    public function home(Request $request) {
        return redirect()->route('index');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('index');
    }
}

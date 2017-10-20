<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Participant;
use App\Term;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $participants = Participant::all();
        $participantsCount = Participant::all()->count();
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));

        return view('dashboard', compact('participants', 'participantsCount', 'currentTermNr'));
    }

    public function reset(Request $request) {
        $terms = Term::all();

        Participant::truncate();

        foreach($terms as $term) {
            $term->winner_participant_id = null;
            $term->save();
        }

        Storage::put(config('globals.current_term_nr_filename'), 1);

        return redirect()->back()->with(
            ['message' => 'Wedstrijd gereset', 'message-type' => 'success']
        );
    }
}

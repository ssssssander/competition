<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Participant;
use App\Term;
use Artisan;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $termCount = Term::count();
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));
        $participants = Participant::all();
        $participants = $participants->sortByDesc('term');
        $totalParticipantCount = Participant::count();
        $thisTermParticipantCount = $participants->where('term', $currentTermNr)->count();

        return view('dashboard', compact('participants', 'totalParticipantCount', 'thisTermParticipantCount', 'currentTermNr', 'termCount'));
    }

    public function reset(Request $request) {
        $participants = Participant::all();

        foreach($participants as $participant) {
            $participant->delete();
        }

        Storage::put(config('globals.current_term_nr_filename'), 1);
        Storage::put(config('globals.term_interval_filename'), 'weekly');

        Artisan::call('migrate:refresh', ['--seed' => 'default']);

        return redirect()->back()->with(
            ['message' => 'Wedstrijd gereset', 'message-type' => 'success']
        );
    }
}

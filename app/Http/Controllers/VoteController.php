<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Participant;

class VoteController extends Controller
{
    public function vote(Request $request) {
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));
        $participantsFromThisTerm = Participant::where('term', $currentTermNr)->get();

        return view('vote', compact('participantsFromThisTerm', 'currentTermNr'));
    }

    public function increment_vote(Participant $participant, Request $request) {
        $participant->increment('votes');

        return redirect()->back()->with(
            ['message' => "Gestemd op <strong>{$participant->name}</strong>", 'message-type' => 'success']
        );
    }
}
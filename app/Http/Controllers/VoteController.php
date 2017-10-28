<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Participant;
use App\Vote;

class VoteController extends Controller
{
    public function vote(Request $request) {
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));
        $participantsFromThisTerm = Participant::where('term', $currentTermNr)->get();
        $ip = $request->ip();
        $vote = new Vote();

        return view('vote', compact('participantsFromThisTerm', 'currentTermNr', 'vote', 'ip'));
    }

    public function increment_vote(Participant $participant, Request $request) {
        $vote = new Vote();
        $ip = $request->ip();
        $hasVotedOnParticipant = $vote->where('ip', $ip)->where('participant_id', $participant->id)->count() >= 1;

        if(!$hasVotedOnParticipant) {
            $vote->ip = $ip;
            $vote->participant_id = $participant->id;

            $vote->save();

            $participant->increment('votes');

            return redirect()->back()->with(
                ['message' => "Gestemd op <strong>{$participant->name}</strong>", 'message-type' => 'success']
            );
        }

        return redirect()->back();
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\TermEnded;
use App\Participant;
use App\Term;
use App\User;

class EndTerm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'term:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End the current term and set everything up for the next term';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));

        if($currentTermNr != 0) {
            // Pick winner
            $termCount = Term::count();
            $currentTerm = Term::find($currentTermNr);
            $winner = Participant::where('term', $currentTermNr)->orderBy('votes', 'desc')->first();

            $currentTerm->winner_participant_id = is_null($winner) ? null : $winner->id;
            $currentTerm->save();

            // Check if the competition is finished
            $nextTermNr = $currentTermNr + 1;

            if($nextTermNr > $termCount) {
                $nextTermNr = 0;
            }

            // Send email
            $adminName = User::find(1)->name;
            $winnerName = is_null($winner) ? 'er is geen winnaar' : $winner->name;
            Mail::send(new TermEnded($adminName, $winnerName, $currentTermNr, $nextTermNr, $termCount));

            // Progress to the next term
            Storage::put(config('globals.current_term_nr_filename'), $nextTermNr);
        }
        else {
            $this->error('The competition is finished');
        }
    }
}

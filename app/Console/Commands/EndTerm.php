<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use App\Participant;
use App\Term;

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
        // Pick winner
        $participants = Participant::all();
        $terms = Term::all();
        $currentTermNr = config('global.current_term');
        $currentTerm = Term::find($currentTermNr);
        $winner = Participant::where('term', $currentTermNr)->orderBy('votes', 'desc')->first();

        $currentTerm->winner_participant_id = $winner->id;
        $currentTerm->save();

        // Determine next term

        // $now = new Carbon();

        // foreach($terms as $term) {
        //     if($now->between(new Carbon($term->start), new Carbon($term->end))) {
        //         //
        //     }
        // }
    }
}

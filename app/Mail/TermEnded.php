<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use App\Participant;
use App\Term;

class TermEnded extends Mailable
{
    use Queueable, SerializesModels;

    public $currentTermNr;
    public $nextTermNr;
    public $winner;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename')) - 1;
        $this->nextTermNr = $this->currentTermNr + 1;

        $currentTerm = Term::find($this->currentTermNr);

        $winner = Participant::where('term', $this->currentTermNr)->orderBy('votes', 'desc')->first();

        $this->winner = $winner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.term_ended');
    }
}

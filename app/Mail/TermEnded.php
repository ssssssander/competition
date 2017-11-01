<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use App\Participant;
use App\Term;
use App\User;

class TermEnded extends Mailable
{
    use Queueable, SerializesModels;

    public $adminName;
    public $winnerName;
    public $currentTermNr;
    public $nextTermNr;
    public $termCount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($adminName, $winnerName, $currentTermNr, $nextTermNr, $termCount)
    {
        $this->adminName = $adminName;
        $this->winnerName = $winnerName;
        $this->currentTermNr = $currentTermNr;
        $this->nextTermNr = $nextTermNr;
        $this->termCount = $termCount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Er is een periode voorbij')->markdown('emails.term_ended');
    }
}

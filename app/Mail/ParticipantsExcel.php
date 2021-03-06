<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Carbon\Carbon;
use Excel;
use DB;

class ParticipantsExcel extends Mailable
{
    use Queueable, SerializesModels;

    public $adminName;
    public $dateNow;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->adminName = User::find(1)->name;
        $this->dateNow = date_format(date_create(Carbon::now()->subHour()), 'd-m-Y');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $excelFile = Excel::create("deelnemers_{$this->dateNow}", function($excel) {
            $excel->sheet("deelnemers_{$this->dateNow}", function($sheet) {
                $dateTimeNow = Carbon::now();
                $dateTimeYesterday = Carbon::now()->subDay();
                $participants = DB::table('participants')
                    ->whereRaw('(created_at BETWEEN ? AND ?) AND (deleted_at IS NULL)', [$dateTimeYesterday, $dateTimeNow])
                    ->get();
                $participants = $participants->map(function($x){ return (array) $x; })->toArray();
                $sheet->fromArray($participants);
                $sheet->row(1, array(
                     'Id', 'Naam', 'Adres', 'Woonplaats', 'E-mailadres', 'IP-adres', 'Gemaakt op', 'Geüpdatet op', 'Verwijderd op', 'Stemmen', 'Afbeeldingspad', 'Periode'
                ));
            });
        });

        return $this->subject('De deelnemers van vandaag')->markdown('emails.participants_excel')->attach($excelFile->store('xlsx', false, true)['full']);
    }
}

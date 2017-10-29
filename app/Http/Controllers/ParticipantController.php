<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Participant;
use Excel;

class ParticipantController extends Controller
{
    public function participate(FormBuilder $formBuilder, Request $request) {
        $ip = $request->ip();
        $hasParticipated = Participant::where('ip', $ip)->exists();

        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));

        $form = $formBuilder->create(\App\Forms\ParticipantForm::class, [
            'method' => 'POST',
            'url' => route('store_participant')
        ]);

        return view('participate', compact('form', 'hasParticipated'));
    }

    public function store_participant(FormBuilder $formBuilder, Request $request) {
        $ip = $request->ip();
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));
        $hasParticipated = Participant::where('ip', $ip)->exists();

        if($hasParticipated) {
            return redirect()->back();
        }

        try {
            $form = $formBuilder->create(\App\Forms\ParticipantForm::class);

            if(!$form->isValid()) {
                return redirect()->back()->withErrors($form->getErrors())->withInput();
            }

            $participant = new Participant($request->all());
            $path = $request->file('image')->store('uploads');
            $participant->image_path = $path;
            $participant->ip = $ip;
            $participant->votes = 0;
            $participant->term = $currentTermNr;

            $participant->save();

            return redirect()->back();
        }
        catch(QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->back();
            }
        }
    }

    public function delete_participant(Participant $participant, Request $request) {
        $participant->delete();

        return redirect()->back()->with(
            ['message' => "Deelnemer <strong>{$participant->name}</strong> verwijderd", 'message-type' => 'success']
        );
    }

    public function export_participants(Request $request) {
        Excel::create('deelnemers', function($excel) {
            $excel->sheet('deelnemers', function($sheet) {
                $participants = Participant::all();
                $sheet->fromArray($participants->toArray());
                $sheet->row(1, array(
                     'Id', 'Naam', 'Adres', 'Woonplaats', 'E-mailadres', 'IP-adres', 'Gemaakt op', 'Geüpdatet op', 'Verwijderd op', 'Stemmen', 'Afbeeldingspad', 'Periode'
                ));
            });
        })->export('xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Participant;
use App\Term;
use App\User;
use Excel;

class PageController extends Controller
{
    public function index(Request $request) {
        // $term = new Term();
        // $term->term = 1;
        // $term->start = Carbon::create(2017, 12, 1, 0, 0, 0);
        // $term->end = Carbon::create(2017, 12, 1, 0, 0, 0)->addWeek()->subSecond();
        // $term->term = 2;
        // $term->start = Carbon::create(2017, 12, 8, 0, 0, 0);
        // $term->end = Carbon::create(2017, 12, 8, 0, 0, 0)->addWeek()->subSecond();
        // $term->term = 3;
        // $term->start = Carbon::create(2017, 12, 15, 0, 0, 0);
        // $term->end = Carbon::create(2017, 12, 15, 0, 0, 0)->addWeek()->subSecond();
        // $term->term = 4;
        // $term->start = Carbon::create(2017, 12, 21, 0, 0, 0);
        // $term->end = Carbon::create(2017, 12, 21, 0, 0, 0)->addWeek()->subSecond();
        // $term->save();

        $terms = Term::all();
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));

        if($currentTermNr == 0) {
            $termNrsSoFar = range(1, count($terms));
        }
        else {
            $termNrsSoFar = range(1, $currentTermNr);
        }

        $termsSoFar = Term::find($termNrsSoFar);
        $winnerIds = array();

        foreach($termsSoFar as $term) {
            array_push($winnerIds, $term->winner_participant_id);
        }

        $winners = Participant::find($winnerIds);
        $winners = $winners->toArray();
        $winnersRightOrder = array();

        for($i = 0; $i < count($terms); $i++) {
            if(array_key_exists($i, $winners)) {
                $winnersRightOrder[$winners[$i]['term'] - 1] = $winners[$i]['name'];
            }
        }

        for($i = 0; $i < count($terms); $i++) {
            if(!array_key_exists($i, $winnersRightOrder)) {
                $winnersRightOrder[$i] = '???';
            }
        }

        return view('index', compact('terms', 'winnersRightOrder', 'currentTermNr'));
    }

    public function home(Request $request) {
        return redirect()->route('index');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('index');
    }

    public function dashboard(FormBuilder $formBuilder, Request $request) {
        $participants = Participant::all();
        $participantsCount = Participant::all()->count();
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));

        return view('dashboard', compact('participants', 'participantsCount', 'currentTermNr'));
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

    public function terms(FormBuilder $formBuilder, Request $request) {
        $terms = Term::all();

        $form = $formBuilder->create(\App\Forms\TermsForm::class, [
            'method' => 'POST',
            'url' => route('edit_terms')
        ]);

        return view('terms', compact('terms', 'form'));
    }

    public function edit_terms(FormBuilder $formBuilder, Request $request) {
        $form = $formBuilder->create(\App\Forms\TermsForm::class);
        $terms = Term::all();
        $iteration = 1;

        if(!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        foreach($terms as $term) {
            $term->start = $request->input('start' . $iteration);
            $term->end = $request->input('end' . $iteration);

            $term->save();
            $iteration++;
        }

        return redirect()->back()->with(
            ['message' => 'Periodes gewijzigd', 'message-type' => 'success']
        );

    }

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

    public function participate(FormBuilder $formBuilder, Request $request) {
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));


            $form = $formBuilder->create(\App\Forms\ParticipantForm::class, [
                'method' => 'POST',
                'url' => route('store_participant')
            ]);

            return view('participate', compact('form'));
    }

    public function store_participant(FormBuilder $formBuilder, Request $request) {
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));

        try {
            $form = $formBuilder->create(\App\Forms\ParticipantForm::class);

            if(!$form->isValid()) {
                return redirect()->back()->withErrors($form->getErrors())->withInput();
            }

            $participant = new Participant($request->all());
            $path = $request->file('image')->store('uploads');
            $participant->image_path = $path;
            $participant->ip = $request->ip();
            $participant->votes = 0;
            $participant->term = $currentTermNr;

            $participant->save();

            return redirect()->back()->with(
                ['message' => 'Je deelname is bevestigd!', 'message-type' => 'success']
            );
        }
        catch(QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->back()->with(
                    ['message' => 'Je deelname is bevestigd!', 'message-type' => 'success']
                );
            }
        }
    }

    public function delete_participant(Participant $participant, Request $request) {
        $participant->delete();

        return redirect()->back()->with(
            ['message' => "Deelnemer <strong>{$participant->name}</strong> verwijderd", 'message-type' => 'success']
        );
    }
}

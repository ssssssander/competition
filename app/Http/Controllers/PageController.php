<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use Carbon\Carbon;
use App\Participant;
use App\Term;
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
        $currentTermNr = config('global.current_term');
        $currentTerm = Term::find($currentTermNr);
        $winner = Participant::find($currentTerm->winner_participant_id);

        return view('index', compact('terms', 'winner'));
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

        return view('dashboard', compact('participants', 'participantsCount'));
    }

    public function export(Request $request) {
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

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        foreach($terms as $term) {
            $term->start = $request->input('start' . $iteration);
            $term->end = $request->input('end' . $iteration);

            $term->save();
            $iteration++;
        }

        return redirect()->back()->with('edit_terms_success', 'Periodes gewijzigd');
    }

    public function vote_page(Request $request) {
        $participants = Participant::all();

        return view('vote_page', compact('participants'));
    }

    public function vote(Participant $participant, Request $request) {
        $participant->increment('votes');

        return redirect()->back();
    }

    public function participate(FormBuilder $formBuilder, Request $request) {
        $form = $formBuilder->create(\App\Forms\ParticipantForm::class, [
            'method' => 'POST',
            'url' => route('store_participant')
        ]);

        return view('participate', compact('form'));
    }

    public function store_participant(FormBuilder $formBuilder, Request $request) {
        $form = $formBuilder->create(\App\Forms\ParticipantForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $participant = new Participant($request->all());
        $path = $request->file('image')->store('uploads', 'uploads');
        $participant->image_path = $path;
        $participant->ip = $request->ip();
        $participant->votes = 0;
        $participant->term = config('global.current_term');

        $participant->save();

        $request->session()->put('store_participant_success', 'Je deelname is bevestigd!');

        return redirect()->back();
    }

    public function delete_participant(Participant $participant, Request $request) {
        $participant->delete();

        return redirect()->back()->with('delete_participant_success', "Deelnemer <strong>{$participant->name}</strong> verwijderd");
    }
}

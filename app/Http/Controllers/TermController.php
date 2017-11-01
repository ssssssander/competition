<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\Storage;
use App\Term;
use Carbon\Carbon;

class TermController extends Controller
{
    public function terms(FormBuilder $formBuilder, Request $request) {
        $form = $formBuilder->create(\App\Forms\TermsForm::class, [
            'method' => 'POST',
            'url' => route('edit_terms')
        ]);

        return view('terms', compact('form'));
    }

    public function edit_terms(FormBuilder $formBuilder, Request $request) {
        $termInterval = $request->input('term_interval');
        $termAmount = $request->input('term_amount');
        $form = $formBuilder->create(\App\Forms\TermsForm::class);

        if(!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Storage::put(config('globals.term_interval_filename'), $termInterval);
        Storage::put(config('globals.current_term_nr_filename'), 1);

        $dateNow = Carbon::now();

        Term::truncate();

        for($i = 0; $i < $termAmount; $i++) {
            $term = new Term();
            $term->term = $i + 1;
            $term->start = $dateNow->toDateString();
            switch($termInterval) {
                case 'daily': $term->end = $dateNow->addDay()->toDateString(); break;
                case 'weekly': $term->end = $dateNow->addWeek()->toDateString(); break;
                case 'monthly': $term->end = $dateNow->addMonth()->toDateString(); break;
                case 'quarterly': $term->end = $dateNow->addMonths(3)->toDateString(); break;
                case 'yearly': $term->end = $dateNow->addYear()->toDateString(); break;
                default: $term->end = $dateNow->addWeek()->toDateString(); break;
            }
            $term->save();
        }

        return redirect()->back()->with(
            ['message' => 'Periodes gewijzigd', 'message-type' => 'success']
        );

        // $form = $formBuilder->create(\App\Forms\TermsForm::class);
        // $terms = Term::all();
        // $iteration = 1;

        // if(!$form->isValid()) {
        //     return redirect()->back()->withErrors($form->getErrors())->withInput();
        // }

        // foreach($terms as $term) {
        //     $term->start = $request->input('start' . $iteration);
        //     $term->end = $request->input('end' . $iteration);

        //     $term->save();
        //     $iteration++;
        // }

        // return redirect()->back()->with(
        //     ['message' => 'Periodes gewijzigd', 'message-type' => 'success']
        // );
    }
}

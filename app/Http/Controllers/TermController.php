<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\Facades\Storage;
use App\Term;

class TermController extends Controller
{
    public function terms(FormBuilder $formBuilder, Request $request) {
        $terms = Term::all();

        $form = $formBuilder->create(\App\Forms\TermsForm::class, [
            'method' => 'POST',
            'url' => route('edit_terms')
        ]);

        return view('terms', compact('terms', 'form'));
    }

    public function edit_terms(FormBuilder $formBuilder, Request $request) {
        $termInterval = $request->input('term_interval');
        $form = $formBuilder->create(\App\Forms\TermsForm::class);

        if(!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $possibleIntervals = ['hourly', 'daily', 'weekly', 'monthly', 'quarterly', 'yearly'];

        if(in_array($termInterval, $possibleIntervals)) {
            Storage::put(config('globals.term_interval_filename'), $termInterval);

            return redirect()->back()->with(
                ['message' => 'Periodes gewijzigd', 'message-type' => 'success']
            );
        }

        return redirect()->back();

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
